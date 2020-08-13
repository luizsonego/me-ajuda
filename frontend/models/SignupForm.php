<?php

namespace frontend\models;

use app\models\AlunoProfile;
use app\models\Auth;
use common\models\Aluno;
use Yii;
use yii\base\Model;
// use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Aluno', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Aluno', 'message' => 'This email address has already been taken.'],

            // ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        $nopass = false;
        if (!$this->validate()) {
            return null;
        }

        $user = new Aluno();
        $user->username = $this->username;
        $user->email = $this->email;
        if ($this->password === '') {
            $randonNumber = rand(100, 999);
            $user->setPassword($this->username . $randonNumber);
            $user->status = 10;
            $nopass = true;
            Yii::$app->session->setFlash('warning', 'Criamos uma senha padrão para você ' . $this->username . $randonNumber);
        } else {
            $user->setPassword($this->password);
        }
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->registration_ip = \Yii::$app->request->userIP;
        $transaction = Aluno::getDb()->beginTransaction();
        if ($user->save()) {
            $userIconDefault = rand(1, 18);
            $profile = new AlunoProfile([
                'aluno_id' => $user->id,
                'public_email' => $user->email,
                'gravatar_id' => 'user_' . str_pad($userIconDefault, 3, 0, STR_PAD_LEFT) . '.svg',
                'name' => $user->username,
                'location' => \Yii::$app->request->userIP,
                'timezone' => \Yii::$app->timezone,
            ]);
            $auth = new Auth([
                'user_id' => $user->id,
                'source' => 'website',
                'source_id' => (string)$user->id,
              ]);
            $transaction->commit();
            $profile->save(0);
            $auth->save(0);
            return $this->sendEmail($user, $nopass);
        }
        // return $user->save() && $this->sendEmail($user, $nopass);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user, $nopass)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => $nopass ? 'emailVerifyNoPass-html' : 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Registro de conta em ' . Yii::$app->name)
            ->send();
    }
}
