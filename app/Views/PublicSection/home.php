<?= $this->extend('PublicSection/base_layout') ?>
    <?= $this->section('title') ?>
        <title><?= $title ?></title>
    <?= $this->endSection() ?>
    <?= $this->section('css') ?>
        <link href="<?= base_url('assets/PublicSection/css/home.css')?>"rel="stylesheet" type="text/css">
    <?= $this->endSection() ?>
    <?= $this->section('js') ?>
        <script type="text/javascript">
            $(document).ready(function(){  
                console.log("Pantalla de Home")
            });
        </script>
    <?= $this->endSection() ?>
    <?= $this->section('section') ?>
        <div class="contenedor">
            <div class="titulos">
                <h1 class="titulo">Festivales</h1>
            </div>
            <h1 class="titulo">Indie</h1>
            <div class="festival">
                <div class="tarjeta">
                        <img src="<?= base_url('assets/PublicSection/img/arts.jpeg')?>">
                    <div class="info">
                        <h3>Card title</h3>
                        <p>Some quick example text to build on the card title and make up the builk of the card´s content.</p>
                        <button class="btn btn-primary" id="boton">Go somewhere</button>
                    </div>
                </div>
                <div class="tarjeta">
                        <img src="<?= base_url('assets/PublicSection/img/arts.jpeg')?>">
                    <div class="info">
                        <h3>Card title</h3>
                        <p>Some quick example text to build on the card title and make up the builk of the card´s content.</p>
                        <button class="btn btn-primary" id="boton">Go somewhere</button>
                    </div>
                </div>
            </div>
            <h1 class="titulo">Rock</h1>

            <div class="festival">
                <div class="tarjeta">
                    <img src="<?= base_url('assets/PublicSection/img/rock.jpeg')?>">
                    <div class="info">
                        <h3>Card title</h3>
                        <p>Some quick example text to build on the card title and make up the builk of the card´s content.</p>
                        <button class="btn btn-primary" id="boton">Go somewhere</button>
                    </div>
                </div>
            </div>
                    <div class="enlaces">
                <a href="<?= route_to('login_page') ?>">Ir a login</a>
                </div>
            
        </div>
        
        
    <?= $this->endSection() ?>



