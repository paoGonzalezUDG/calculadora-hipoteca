<?php
   if(!isset($_GET['id_propiedad']) || empty($_GET['id_propiedad'])) {
       $costo_propiedad = 800000;
   }elseif($_GET['id_propiedad'] == 1) {
       $costo_propiedad = 708800;//Lot 1 – Appartement Echallens
   }elseif($_GET['id_propiedad'] == 2) {
       $costo_propiedad = 660800;//Lot 2 – Appartement Echallens
   }elseif($_GET['id_propiedad'] == 3) {
       $costo_propiedad = 514400;//Lot 3 – Appartement Echallens
   }elseif($_GET['id_propiedad'] == 4) {
       $costo_propiedad = 1082400;//Lot 4 – Appartement Echallens               
   }elseif($_GET['id_propiedad'] == 5) {
       $costo_propiedad = 943200;//Lot 5 – Appartement Echallens
   }elseif($_GET['id_propiedad'] == 6) {
       $costo_propiedad = 596800;//Lot 6 – Appartement Echallens
   }elseif($_GET['id_propiedad'] == 7) {
       $costo_propiedad = 958400;//Lot 7 – Appartement Echallens
   }elseif($_GET['id_propiedad'] == 8) {
       $costo_propiedad = 783200;//Lot 8 – Appartement Echallens
   }elseif($_GET['id_propiedad'] == 9) {
       $costo_propiedad = 943200;//Lot 9 – Appartement Echallens
   }elseif($_GET['id_propiedad'] == 10) {
       $costo_propiedad = 650000;//Grenade
   }else{
            $costo_propiedad = 800000;//Petit Château
        } ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calculadora de Hipoteca</title>
        <link rel="stylesheet" href="/calculateur/style.css">
        <script>
            let costo_propiedad = "<?php echo floatval($costo_propiedad); ?>";
        </script>
    </head>
    <body>

        <div class="main-container">
            <div class="calculator-container">
                <!-- Sección de Entradas (Derecha) -->
                <div class="input-fields">
                    <!-- Campo dinamico -->
                    <div class="form-group">
                        <label class="f-bold">Precio de compra</label>
                        <p id="property-price-display" class="calculated-field"></p>
                        <input type="range" id="property-price-slider" class="price-slider">
                    </div>
                    <!-- Campos Fijos -->
                    <div class="form-group">
                        <label class="f-bold">Tasa de interés</label>
                        <p id="interest-rate-display" class="calculated-field input-static"></p>
                    </div>
                    <div class="form-group">
                        <label class="f-bold">Intereses anuales</label>
                        <p id="annual-interest-display" class="calculated-field input-static"></p>
                    </div>
                    <div class="form-group">
                        <label class="f-bold">Gastos de mantenimiento (1%)</label>
                        <p id="maintenance-costs-display" class="calculated-field input-static"></p>
                    </div>

                    <!-- Aportación (Equidad) -->
                    <div class="form-group full-width">
                        <label id="equity-label" class="f-bold">Fondos propios (20%)</label>
                        <div class="equity-controls">
                            <p id="equity-amount-display" class="calculated-field"></p>
                            <span id="equity-percentage" class="percentage-box"></span>
                        </div>
                        <input type="range" id="equity-slider" min="20" max="100" value="20" step="1">
                    </div>
                    
                    <!-- Campos Calculados -->
                    <div class="form-group opacity">
                        <label class="f-bold">Monto de la hipoteca</label>
                        <p id="mortgage-amount" class="calculated-field"></p>
                    </div>
                    <div class="form-group opacity">
                        <label class="f-bold">Término</label>
                        <select id="loan-term">
                            <option value="2" selected>2 años</option>
                        </select>
                    </div>
                </div>

                <!-- Sección de Resultados (Izquierda) -->
                <div class="result-display">
                    <div id="monthly-payment" class="payment-amount"></div>
                    <div id="calculation-details" class="f-bold details-text"></div>
                    <hr>
                    <div class="d-sm-flex align-items-baseline justify-content-end w-100">
                        <label class="details-text">Costos anuales totales</label>
                        <p id="total-annual-costs-display" class="details-text"></p>
                    </div>
                </div>
            </div>
        </div>

        <script src="/calculateur/financement.js"></script>
        <script>
            function sendHeight() {
                const height = document.body.scrollHeight;
                window.parent.postMessage({ height: height }, '*');
            }

            window.addEventListener('load', sendHeight);
            window.addEventListener('resize', sendHeight);
            setInterval(sendHeight, 1000); // por si cambia dinámicamente
        </script>
    </body>
</html>