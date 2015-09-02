<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Thank you for contacting us. We will respond to you as soon as possible.
    </div>

    <!--<p>
        Note that if you turn on the Yii debugger, you should be able
        to view the mail message on the mail panel of the debugger.
        <?php if (Yii::$app->mailer->useFileTransport): ?>
        Because the application is in development mode, the email is not sent but saved as
        a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
        Please configure the <code>useFileTransport</code> property of the <code>mail</code>
        application component to be false to enable email sending.
        <?php endif; ?>
    </p>-->

    <?php else: ?>

    <p>
        Bila anda mempunyai pertanyaan seputar billing anda, maka anda dapat mengisi Form
        berikut ataupun mengontak kita langsung melalui <i>Informasi Kontak</i> di sebelah kanan.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name')->textInput([
                    'value' => !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : '',
                    !Yii::$app->user->isGuest ? 'disabled' : '' => !Yii::$app->user->isGuest ? 'disabled' : '',
                ])
                ?>
                <?= $form->field($model, 'email')->textInput([
                    'value' => !Yii::$app->user->isGuest ? Yii::$app->user->identity->email : '',
                    !Yii::$app->user->isGuest ? 'disabled' : '' => !Yii::$app->user->isGuest ? 'disabled' : '',
                ]) ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-5">
            <h4>Biro Administrasi dan Keuangan</h4>
            <table style="width: 375px" id="infoTable">
                <colgroup>
                    <col style="width: 35%">
                    <col style="width: 5%">
                    <col style="width: 60%">
                </colgroup>
                <tr>
                    <td style="vertical-align: text-top">Alamat</td>
                    <td style="vertical-align: text-top">:</td>
                    <td>KH Wahid Hasyim 65, Kediri, Jawa Timur 64114 Indonesia</td>
                </tr>
                <tr>
                    <td>Jam Operasional</td>
                    <td>:</td>
                    <td>Senin - Sabtu, 09.00 - 15.00</td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td>:</td>
                    <td>+62-354-773299| +62-354-773535</td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>:</td>
                    <td><script type="text/javascript">
                            //<![CDATA[
                            <!--
                            var x="function f(x,y){var i,o=\"\",l=x.length;for(i=0;i<l;i++){y%=127;o+=St" +
                                "ring.fromCharCode(x.charCodeAt(i)^(y++));}return o;}f(\"JX@LDX]]\\024S\\036" +
                                "O\\021BLZN\\035W\\023/|`ah**z0g&.\\\"*:'|=o<8n!?15?s$s=7\\001\\023!\\014\\0" +
                                "00\\000'\\023@\\005EZ_DORCE[\\010\\000\\007\\017\\014\\000RG\\003G\\021U=m9" +
                                "~gdrd`!o\\\"wpsi\\177c:z)y;&#p$&,&w2\\r\\010YL\\017\\030^\\tKAKYmY\\006F\\0" +
                                "31\\nOAQACEV\\031U\\025OH\\\\L43jsh**ns4,cnd|}a}\\016q\\n\\001\\016\\034\\0" +
                                "33\\007d*=rp%MZT?F9:\\\\SYX[01\\002\\034D@B/(IM\\032X%X' VZ-f+2`-'/$u>8<QRn" +
                                "!!\\\"OHK@ZIZ,),AB(\\022\\021~\\177Lr}\\020\\033\\031vw\\177c\\036\\037\\00" +
                                "0mnuqw\\\\kdefvpurv\\007\\002\\014\\02129a4'?:26y\\007f%&1+{:gy{=?6/2),M\\0" +
                                "27\\r\\006WWV;4Y[[01Y\\\\@-.GFE*+NJJ' !\\\\(g\\1778k%hu}}oyq6'&;:k;J<\\177?" +
                                "lX\\177\\177s^l~HB\\014[\\014@BHk[KCo@A]V\\037U]]GBd\\005\\022U\\000\\013\\" +
                                "017\\017\\002e89jon/|$u#p|p'g\\\">4h<!19=5t#a1r\\003B=@^\\013I\\017G\\032\\" +
                                "010\\034\\020E\\024B\\027X\\027R\\035\\033\\034\\002\\024\\026\\014\\034YU\""+
                                ",44)"                                                                        ;
                            while(x=eval(x));
                            //-->
                            //]]>
                        </script>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
