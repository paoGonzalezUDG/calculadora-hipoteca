document.addEventListener('DOMContentLoaded', () => {

    // --- 1. CONSTANTES Y VALORES INICIALES ---
    const PROPERTY_PRICE        = 800000;
    const INTEREST_RATE         = 1.50;
    const MIN_EQUITY_PERCENT    = 20;
    const MAINTENANCE_RATE      = 0.01;

    // --- 2. ELEMENTOS DEL DOM ---
    const equitySlider          = document.getElementById('equity-slider');
    const equityAmountDisplay   = document.getElementById('equity-amount-display'); // NUEVO
    
    const propertyPriceDisplay      = document.getElementById('property-price-display');
    const interestRateDisplay       = document.getElementById('interest-rate-display');
    const loanTermInput             = document.getElementById('loan-term');
    const equityPercentageDisplay   = document.getElementById('equity-percentage');
    const equityLabel               = document.getElementById('equity-label');
    const monthlyPaymentDisplay     = document.getElementById('monthly-payment');
    const calculationDetailsDisplay = document.getElementById('calculation-details');
    const mortgageAmountDisplay     = document.getElementById('mortgage-amount');
    const annualInterestDisplay     = document.getElementById('annual-interest-display');
    const maintenanceCostsDisplay   = document.getElementById('maintenance-costs-display');
    const totalAnnualCostsDisplay   = document.getElementById('total-annual-costs-display');

    // --- FUNCIÓN AUXILIAR DE FORMATEO (La de parse ya no es necesaria) ---
    const formatNumber = (num) => {
        return num.toLocaleString('de-CH');
    };

    // --- 3. FUNCIÓN DE INICIALIZACIÓN ---
    function initializeCalculator() {
        propertyPriceDisplay.textContent    = `CHF ${formatNumber(PROPERTY_PRICE)}`;
        interestRateDisplay.textContent     = `${INTEREST_RATE.toFixed(2)} %`;
        equitySlider.value                  = MIN_EQUITY_PERCENT;
        equityLabel.textContent             = `Fonds propres* (${MIN_EQUITY_PERCENT}%)`;
    }

    // --- 4. FUNCIÓN PRINCIPAL DE CÁLCULO ---
    function calculateMortgage() {
        const price                 = PROPERTY_PRICE;
        const interestRate          = INTEREST_RATE;
        const termYears             = parseInt(loanTermInput.value, 10) || 0;
        
        // CAMBIO: El monto de la equidad se calcula directamente desde el slider
        const equityPercentage      = parseFloat(equitySlider.value);
        const equityAmount          = price * (equityPercentage / 100);
        
        const principal             = price - equityAmount;
        const annualInterest        = principal * (interestRate / 100);
        const maintenanceCosts      = price * MAINTENANCE_RATE;
        const totalAnnualCosts      = annualInterest + maintenanceCosts;
        const estimatedMonthlyCost  = totalAnnualCosts / 12;

        // Actualizar el display de "Fondos Propios"
        equityAmountDisplay.textContent     = `CHF ${formatNumber(Math.round(equityAmount))}`;

        // Actualizar el resto de la interfaz
        mortgageAmountDisplay.textContent   = `CHF ${formatNumber(Math.max(0, principal))}`;
        annualInterestDisplay.textContent   = `CHF ${formatNumber(Math.max(0, annualInterest))}`;
        maintenanceCostsDisplay.textContent = `CHF ${formatNumber(maintenanceCosts)}`;
        totalAnnualCostsDisplay.textContent = `CHF ${formatNumber(Math.max(0, totalAnnualCosts))}`;
        
        const formattedMonthlyCost              = estimatedMonthlyCost.toLocaleString('de-CH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        monthlyPaymentDisplay.textContent       = `CHF ${formattedMonthlyCost} / mes`;
        calculationDetailsDisplay.textContent   = `${termYears} años, ${interestRate.toFixed(2)}% d'intérêt`;
    }

    // --- 5. SINCRONIZACIÓN (SIMPLIFICADA) ---
    function syncEquity() {
        // Esta función ahora solo necesita actualizar el % y llamar al cálculo principal
        const percentage                    = parseFloat(equitySlider.value);
        equityPercentageDisplay.textContent = `${Math.round(percentage)}%`;
        calculateMortgage();
    }

    // --- 6. EVENT LISTENERS (SIMPLIFICADOS) ---
    loanTermInput.addEventListener('change', calculateMortgage);
    equitySlider.addEventListener('input', syncEquity);

    // --- 7. EJECUCIÓN INICIAL ---
    initializeCalculator();
    syncEquity(); // Llama a la función simplificada para el cálculo inicial
});