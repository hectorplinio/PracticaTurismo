<?= $this->extend('PublicSection/base_layout') ?>
    <?= $this->section('title') ?>
        <title><?= $title ?></title>
    <?= $this->endSection() ?>
    <?= $this->section('css') ?>
        <link href="<?= base_url('assets/PublicSection/css/login.css')?>"rel="stylesheet" type="text/css">
    <?= $this->endSection() ?>
    <?= $this->section('js') ?>
        <script type="text/javascript">
            $(document).ready(function(){      
                $('#formulario').on("submit", function(event){
                    event.preventDefault();
                    let data = new FormData(this);
                    $.ajax({
                        url: "<?= route_to('formulario') ?>",
                        type: "POST",
                        data: data,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        async: true,
                        timeout: 5000,
                        beforeSend:(xhr) =>{

                        },
                        success: (response) =>{
                            $('.toast').toast('show')
                            console.log(response.data);
                            if (response.message == "Usuario no encontrado"){
                                $("#bg-primary").removeClass('toast align-items-center text-white bg-primary border-0').addClass('toast align-items-center text-white bg-danger border-0')
                            }else if (response.message == "Usuario encontrado"){
                                $("#bg-primary").removeClass('toast align-items-center text-white bg-danger border-0').addClass('toast align-items-center text-white bg-primary border-0');
                                if (response.data == "admin"){
                                    window.location.replace('<?= route_to("admin_page") ?>');
                                }else if (response.data == "app_client"){
                                    window.location.replace('<?= route_to("home_page") ?>');
                                }
                            }else if (response.message == "Usuario encontrado pero contraseña no coincide"){
                                $("#bg-primary").removeClass('toast align-items-center text-white bg-primary border-0').addClass('toast align-items-center text-white bg-warning border-0')
                                $("#bg-primary").removeClass('toast align-items-center text-white bg-danger border-0').addClass('toast align-items-center text-white bg-warning border-0')
                            }
                            toast.innerHTML=response.message;
                        },
                        error: (xhr, status, error) =>{
                            console.log(error);
                            alert("Se ha producido un error");
                        },
                        complete: () =>{

                        }
                    });
                });
            });
        </script>
    <?= $this->endSection() ?>
    <?= $this->section('section') ?>
    <div class="toast" style=" height: 3em; position: absolute; margin-top: 2em; text-align: right;">
        <div class="toast align-items-center text-white bg-primary border-0" id="bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toast">
                
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
        <div class="contenedor">
            <div class="logo">
                <img src="<?= base_url('assets/PublicSection/img/cuenca.jpeg')?>">
            </div>
                <h1 class="titulo">Please sign in</h1>
                <form class="formulario" id="formulario" method="POST">
                    <input type="text" class="form-control" placeholder="Email address" name="email" id="email">
                    <input type="pass" class="form-control" placeholder="Password" name="password" id="password">
                    <button class="btn btn-primary" id="formulario" type="submit">Sign in</button>
                </form>
                <!-- <button id="btn-ajax" class="btn btn-primary" type="submit">AJAX</button> -->

                <p id="fecha">©️&nbsp2017-2021</p>
                <div class="enlaces">
                    <a href="<?= route_to('home_page') ?>">Ir a inicio publico</a>
                    <a href="<?= route_to('admin_page') ?>">Ir a inicio privado</a>
                </div>

            
        </div>
        
        
    <?= $this->endSection() ?>

