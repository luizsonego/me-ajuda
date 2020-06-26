<?php
namespace frontend\models;

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
        if($this->password === '') {
            $randonNumber = rand(100,999);
            $user->setPassword($this->username.$randonNumber);
            $user->status = 10;
            $nopass = true;
            Yii::$app->session->setFlash('warning', 'Criamos uma senha padrão para você '. $this->username.$randonNumber. '*'. $randonNumber);
        }else{
            $user->setPassword($this->password);
        }
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user, $nopass);

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
