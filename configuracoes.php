<?php
require_once 'config.php';
require_once 'models/Auth.php';
require_once 'dao/UserDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'config';

$userDao = new UserDaoMysql($pdo);

require 'partials/header.php';
require 'partials/menu.php';
?>
<section class="feed mt-10">
    
    <h1>Configurações</h1>

    <?php if(!empty($_SESSION['flash'])): ?>
                <?=$_SESSION['flash'];?>
                <?php $_SESSION['flash'] = ''; ?>
            <?php endif; ?>

    <form method="POST" class="config-form" enctype="multipart/form-data" action="configuracoes_action.php">
        <label>
            Foto Perfil:<br/>
            <input type="file" nome="avatar" />
                <br/>
            <img class="mini" src="<?=$base;?>/media/avatars/<?=$userInfo->avatar;?>" />
        </label>
        <br/>
        <label>
            Foto Capa:<br/>
            <input type="file" nome="cover" />
                <br/>
            <img class="mini" src="<?=$base;?>/media/covers/<?=$userInfo->cover;?>" />
        </label>

        <hr/>

        <label>
            Nome Completo:<br/>
            <input type="text" nome="name" value="<?=$userInfo->name;?>" />
        </label>

        <label>
            Novo E-mail:<br/>
            <input type="email" nome="email" value="<?=$userInfo->email;?>" />
        </label>

        <label>
            Data de Nascimento:<br/>
            <input type="text" id="birthdate" nome="birthdate" value="<?=date('d/m/y', strtotime($userInfo->birthdate));?>" />
        </label>

        <label>
            Cidade:<br/>
            <input type="text" nome="city" value="<?=$userInfo->city;?>" />
        </label>

        <label>
            Profisão:<br/>
            <input type="text" nome="work" value="<?=$userInfo->work;?>" />
        </label>

        <hr/>

        <h1>Nova senha</h1>
        <label>
            Senha:<br/>
            <input type="password" nome="password" />
        </label>

        
        <label>
            Confirmar Senha:<br/>
            <input type="password" nome="password_confirmation" />
        </label>

        <button class="button">salvar</button>
    </form>
</section>
<script src="https://unpkg.com/imask"></script>
    <script>
    IMask(
        document.getElementById("birthdate"),
        {mask:'00/00/0000'}
    );
    </script>
<?php
require 'partials/footer.php';
?>