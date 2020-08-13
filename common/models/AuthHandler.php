<?php

namespace common\models;

use app\models\AlunoProfile;
use app\models\Auth;
use app\models\Profile;
use common\models\Aluno as User;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
  /**
   * @var ClientInterface
   */
  private $client;

  public function __construct(ClientInterface $client)
  {
    $this->client = $client;
  }

  public function handle()
  {
    $attributes = $this->client->getUserAttributes();
    $email = ArrayHelper::getValue($attributes, 'email');
    $id = ArrayHelper::getValue($attributes, 'id');
    $nickname = ArrayHelper::getValue($attributes, 'name');

    /* @var Auth $auth */
    $auth = Auth::find()->where([
      'source' => $this->client->getId(),
      'source_id' => $id,
    ])->one();

    if (empty($email)) {
      Yii::$app->getSession()->setFlash(
        'error',
        Yii::t('app', 'Unable to login in the user. No email address provided'),
      );
      return false;
    }

    if (Yii::$app->user->isGuest) {
      if ($auth) { // login
        /* @var User $user */
        $user = $auth->user;
        if (!$this->updateUserInfo($user)) {
          Yii::$app->getSession()->setFlash(
            'error',
            Yii::t('app', 'Unable to login in the user', [
              'client' => $this->client->getTitle(),
              'errors' => json_encode($auth->getErrors()),
            ]),
          );
        }
        Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
      } else { // signup
        // $existingUser = User::findOne(['email' => $email]);
        // if ($existingUser) {
        //   $auth = new Auth([
        //     'user_id' => $existingUser->id,
        //     'source' => $this->client->getId(),
        //     'source_id' => (string)$id,
        //   ]);
        //   if($this->updateUserInfo($existingUser) && $auth->save()){
        //     Yii::$app->user->login($existingUser, Yii::$app->params['user.rememberMeDuration']);
        //   }
        // }
        if ($email !== null && User::find()->where(['email' => $email])->exists()) {
          Yii::$app->getSession()->setFlash('error', [
            Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $this->client->getTitle()]),
          ]);
        } else {
          $password = Yii::$app->security->generateRandomString(12);
          $user = new User([
            'username' => $nickname,
            'email' => $email,
            'status' => User::STATUS_ACTIVE,
            'password' => $password,
          ]);
          $user->generateAuthKey();
          $user->generatePasswordResetToken();

          $transaction = User::getDb()->beginTransaction();

          if ($user->save()) {
            $auth = new Auth([
              'user_id' => $user->id,
              'source' => $this->client->getId(),
              'source_id' => (string)$id,
            ]);
            if ($auth->save()) {
              $profile = new AlunoProfile([
                'aluno_id' => $user->id,
                'name' => $nickname,
                'public_email' => $user->email,
                'gravatar_id' => (string)$id,
              ]);
              $transaction->commit();
              $user->last_login_at = time();
              $user->last_login_ip = \Yii::$app->request->userIP;
              $user->registration_ip = \Yii::$app->request->userIP;
              $user->save(0);
              $profile->save(0);
              Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
            } else {
              $transaction->rollBack();
              Yii::$app->getSession()->setFlash(
                'error',
                Yii::t('app', 'Unable to save {client} account: {errors}', [
                  'client' => $this->client->getTitle(),
                  'errors' => json_encode($auth->getErrors()),
                ]),
              );
            }
          } else {
            $transaction->rollBack();
            Yii::$app->getSession()->setFlash(
              'error',
              Yii::t('app', 'Unable to save user: {errors}', [
                'client' => $this->client->getTitle(),
                'errors' => json_encode($user->getErrors()),
              ]),
            );
          }
        }
      }
    } else { // user already logged in
      if (!$auth) { // add auth provider
        $auth = new Auth([
          'user_id' => Yii::$app->user->id,
          'source' => $this->client->getId(),
          'source_id' => (string)$attributes['id'],
        ]);
        if ($auth->save()) {
          /** @var User $user */
          $user = $auth->user;
          $this->updateUserInfo($user);
          Yii::$app->getSession()->setFlash('success', [
            Yii::t('app', 'Linked {client} account.', [
              'client' => $this->client->getTitle()
            ]),
          ]);
        } else {
          Yii::$app->getSession()->setFlash('error', [
            Yii::t('app', 'Unable to link {client} account: {errors}', [
              'client' => $this->client->getTitle(),
              'errors' => json_encode($auth->getErrors()),
            ]),
          ]);
        }
      } else { // there's existing auth
        Yii::$app->getSession()->setFlash('error', [
          Yii::t(
            'app',
            'Unable to link {client} account. There is another user using it.',
            ['client' => $this->client->getTitle()]
          ),
        ]);
      }
    }
  }

  /**
   * @param User $user
   */
  private function updateUserInfo(User $user)
  {
    if ($user->status === User::STATUS_INACTIVE) {
      $password = Yii::$app->security->generateRandomString(60);
      $user->status = User::STATUS_ACTIVE;
      $user->password = $password;
      return $user->save();
    }

    if ($user->status === User::STATUS_DELETED) {
      return false;
    }

    $user->last_login_at = time();
    $user->last_login_ip = \Yii::$app->request->userIP;
    return $user->save();

    // $attributes = $this->client->getUserAttributes();
    // $github = ArrayHelper::getValue($attributes, 'login');
    // if ($user->github === null && $github) {
    //   $user->github = $github;
    //   $user->save();
    // }
  }
}
