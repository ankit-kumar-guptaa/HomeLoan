<!-- Bootstrap 5 CDN -->


<section id="calculator" class="emi-calc-section py-5">
  <style>
    .emi-calc-section {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      position: relative;
      overflow: hidden;
    }
    
    .emi-calc-bg-pattern {
      position: absolute;
      top: 0;
      right: 0;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(59,130,246,0.05) 0%, transparent 70%);
      border-radius: 50%;
    }
    
    .emi-calc-badge {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      color: #fff;
      padding: 0.6rem 1.5rem;
      border-radius: 25px;
      font-size: 0.9rem;
      font-weight: 600;
      display: inline-block;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 15px rgba(59,130,246,0.3);
    }
    
    .emi-calc-card {
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      border: 1px solid #e2e8f0;
      position: relative;
    }
    
    .emi-calc-slider {
      width: 100%;
      height: 8px;
      border-radius: 4px;
      background: #e2e8f0;
      outline: none;
      -webkit-appearance: none;
      cursor: pointer;
    }
    
    .emi-calc-slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: #3b82f6;
      cursor: pointer;
      box-shadow: 0 2px 10px rgba(59,130,246,0.3);
      transition: 0.2s;
    }
    
    .emi-calc-slider::-webkit-slider-thumb:hover {
      transform: scale(1.2);
      box-shadow: 0 4px 15px rgba(59,130,246,0.5);
    }
    
    .emi-calc-slider::-moz-range-thumb {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: #3b82f6;
      border: none;
      cursor: pointer;
      box-shadow: 0 2px 10px rgba(59,130,246,0.3);
    }
    
    .emi-calc-display {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      color: #fff;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 8px 25px rgba(59,130,246,0.2);
    }
    
    .emi-calc-amount {
      font-size: 2.5rem;
      font-weight: 800;
      color: #fff;
    }
    
    .emi-calc-breakdown-item {
      background: #f8fafc;
      border-radius: 10px;
      border-left: 4px solid #e5e7eb;
      transition: 0.3s;
    }
    
    .emi-calc-breakdown-item.emi-calc-principal {
      border-left-color: #3b82f6;
      background: #eff6ff;
    }
    
    .emi-calc-breakdown-item.emi-calc-interest {
      border-left-color: #f59e0b;
      background: #fffbeb;
    }
    
    .emi-calc-breakdown-item.emi-calc-total {
      border-left-color: #10b981;
      background: #f0fdf4;
    }
    
    .emi-calc-chart-container {
      background: #f8fafc;
      border-radius: 12px;
      border: 1px solid #e2e8f0;
      height: 240px;
    }
    
    .btn-primary-custom {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      border: none;
      box-shadow: 0 4px 15px rgba(59,130,246,0.3);
    }
    
    .btn-primary-custom:hover {
      background: linear-gradient(135deg, #1d4ed8, #1e40af);
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(59,130,246,0.4);
    }
    
    .btn-outline-custom {
      border: 2px solid #3b82f6;
      color: #3b82f6;
    }
    
    .btn-outline-custom:hover {
      background: #3b82f6;
      color: #fff;
      transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
      .emi-calc-amount {
        font-size: 2rem;
      }
      
      .emi-calc-chart-container {
        height: 200px;
      }
    }
    
    @media (max-width: 576px) {
      .emi-calc-amount {
        font-size: 1.5rem;
      }
      
      .emi-calc-chart-container {
        height: 180px;
      }
    }
  </style>

  <!-- Background Pattern -->
  <div class="emi-calc-bg-pattern"></div>

  <div class="container position-relative">
    <!-- Header -->
    <div class="row">
      <div class="col-12 text-center mb-5">
        <div class="emi-calc-badge">📊 EMI Calculator</div>
        <h2 class="display-5 fw-bold mb-3">Smart EMI Calculator</h2>
        <p class="lead text-muted">Calculate your monthly EMI with real-time updates and detailed breakdown. Plan your home loan with confidence.</p>
      </div>
    </div>

    <div class="row g-4">
      <!-- Left Column - Form -->
      <div class="col-12 col-lg-7">
        <div class="emi-calc-card p-4">
          <h3 class="text-center mb-4 fw-bold">
            <i class="fas fa-calculator me-2"></i>Loan Parameters
          </h3>
          
          <!-- Loan Amount -->
          <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="fw-semibold">Loan Amount</span>
              <span class="fw-bold text-primary fs-5">₹<span id="emiCalcLoanAmountValue">25,00,000</span></span>
            </div>
            <input id="emiCalcLoanAmount" type="range" min="100000" max="10000000" value="2500000" class="emi-calc-slider form-range">
            <div class="d-flex justify-content-between small text-muted mt-2">
              <span>₹1L</span>
              <span>₹1Cr</span>
            </div>
          </div>
          
          <!-- Interest Rate -->
          <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="fw-semibold">Interest Rate</span>
              <span class="fw-bold text-primary fs-5"><span id="emiCalcInterestRateValue">8.5</span>% p.a.</span>
            </div>
            <input id="emiCalcInterestRate" type="range" min="6" max="15" step="0.1" value="8.5" class="emi-calc-slider form-range">
            <div class="d-flex justify-content-between small text-muted mt-2">
              <span>6%</span>
              <span>15%</span>
            </div>
          </div>
          
          <!-- Loan Tenure -->
          <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="fw-semibold">Loan Tenure</span>
              <span class="fw-bold text-primary fs-5"><span id="emiCalcLoanTenureValue">20</span> Years</span>
            </div>
            <input id="emiCalcLoanTenure" type="range" min="1" max="30" value="20" class="emi-calc-slider form-range">
            <div class="d-flex justify-content-between small text-muted mt-2">
              <span>1 Year</span>
              <span>30 Years</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column - Results -->
      <div class="col-12 col-lg-5">
        <div class="emi-calc-card p-4 sticky-top" style="top: 2rem;">
          <!-- EMI Display -->
          <div class="emi-calc-display p-4 mb-4">
            <h5 class="mb-3 opacity-75">Monthly EMI</h5>
            <div class="emi-calc-amount mb-2">₹<span id="emiCalcResult">21,112</span></div>
            <div class="small bg-light bg-opacity-25 rounded-pill px-3 py-1 d-inline-block">
              For <span id="emiCalcTenureDisplay">20</span> years
            </div>
          </div>
          
          <!-- Payment Breakdown -->
          <div class="mb-4">
            <h5 class="fw-bold mb-3">Payment Breakdown</h5>
            
            <div class="emi-calc-breakdown-item emi-calc-principal p-3 mb-3">
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Principal Amount</span>
                <span class="fw-bold" id="emiCalcPrincipalAmount">₹25,00,000</span>
              </div>
            </div>
            
            <div class="emi-calc-breakdown-item emi-calc-interest p-3 mb-3">
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Total Interest</span>
                <span class="fw-bold" id="emiCalcTotalInterest">₹25,66,880</span>
              </div>
            </div>
            
            <div class="emi-calc-breakdown-item emi-calc-total p-3">
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Total Payable</span>
                <span class="fw-bold" id="emiCalcTotalAmount">₹50,66,880</span>
              </div>
            </div>
          </div>
          
          <!-- Chart -->
          <div class="emi-calc-chart-container d-flex align-items-center justify-content-center p-3 mb-4">
            <canvas id="emiCalcChart" style="max-width: 100%; max-height: 100%;"></canvas>
          </div>
          
          <!-- Action Buttons -->
          <div class="row g-2">
            <div class="col-6 col-sm-12 col-lg-6">
              <button class="btn btn-primary-custom w-100 py-2" onclick="emiCalcApplyForLoan()">
                <i class="fas fa-paper-plane me-2"></i>Apply Now
              </button>
            </div>
            <div class="col-6 col-sm-12 col-lg-6">
              <button class="btn btn-outline-custom w-100 py-2" onclick="emiCalcDownloadReport()">
                <i class="fas fa-download me-2"></i>Download Report
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"></script>
  
  <script>
    function emiCalcInitCalculator() {
      const sliders = ['emiCalcLoanAmount', 'emiCalcInterestRate', 'emiCalcLoanTenure'];
      sliders.forEach(id => {
        const slider = document.getElementById(id);
        slider.addEventListener('input', () => {
          emiCalcUpdateSliderTrack(slider);
          emiCalcCalculateEMI();
        });
        emiCalcUpdateSliderTrack(slider);
      });
      emiCalcCalculateEMI();
      setTimeout(() => emiCalcInitChart(), 500);
    }
    
    function emiCalcUpdateSliderTrack(slider) {
      const value = (slider.value-slider.min)/(slider.max-slider.min)*100;
      slider.style.background =
        `linear-gradient(to right, #3b82f6 0%, #3b82f6 ${value}%, #e2e8f0 ${value}%, #e2e8f0 100%)`;
    }
    
    function emiCalcCalculateEMI() {
      const principal = parseFloat(document.getElementById('emiCalcLoanAmount').value);
      const rate = parseFloat(document.getElementById('emiCalcInterestRate').value);
      const tenure = parseFloat(document.getElementById('emiCalcLoanTenure').value);
      
      emiCalcAnimateValue('emiCalcLoanAmountValue', emiCalcFormatNumber(principal));
      emiCalcAnimateValue('emiCalcInterestRateValue', rate.toFixed(1));
      emiCalcAnimateValue('emiCalcLoanTenureValue', tenure.toString());
      document.getElementById('emiCalcTenureDisplay').textContent = tenure;
      
      const monthlyRate = rate / 12 / 100;
      const months = tenure * 12;
      const emi = (principal * monthlyRate * Math.pow(1 + monthlyRate, months)) /
                  (Math.pow(1 + monthlyRate, months) - 1);
      const totalAmount = emi * months;
      const totalInterest = totalAmount - principal;
      
      emiCalcAnimateValue('emiCalcResult', emiCalcFormatNumber(emi));
      emiCalcAnimateValue('emiCalcPrincipalAmount', '₹'+emiCalcFormatNumber(principal));
      emiCalcAnimateValue('emiCalcTotalInterest', '₹'+emiCalcFormatNumber(totalInterest));
      emiCalcAnimateValue('emiCalcTotalAmount', '₹'+emiCalcFormatNumber(totalAmount));
      
      emiCalcUpdateChart(principal, totalInterest);
    }
    
    function emiCalcAnimateValue(elementId, newValue) {
      const element = document.getElementById(elementId);
      element.style.transform = 'scale(1.05)';
      element.style.transition = 'transform 0.2s ease';
      setTimeout(() => {
        element.textContent = newValue;
        element.style.transform = 'scale(1)';
      }, 100);
    }
    
    let emiCalcChart = null;
    function emiCalcInitChart() {
      const canvas = document.getElementById('emiCalcChart');
      if (!canvas || typeof Chart === 'undefined') return;
      const ctx = canvas.getContext('2d');
      emiCalcChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Principal', 'Interest'],
          datasets: [{
            data: [2500000, 2566880],
            backgroundColor: ['#3b82f6', '#f59e0b'],
            borderColor: ['#1d4ed8', '#d97706'],
            borderWidth: 2,
            hoverOffset: 10
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                usePointStyle: true,
                padding: 15,
                font: {size: 12, weight: '500'}
              }
            },
            tooltip: {
              backgroundColor: '#1e293b',
              titleColor: '#fff',
              bodyColor: '#fff',
              borderColor: '#3b82f6',
              borderWidth: 1,
              cornerRadius: 8,
              callbacks: {
                label: function(ctx) {
                  const label = ctx.label || '';
                  const value = '₹'+emiCalcFormatNumber(ctx.parsed);
                  const total = ctx.dataset.data.reduce((a,b)=>a+b,0);
                  const percentage = ((ctx.parsed/total)*100).toFixed(1);
                  return `${label}: ${value} (${percentage}%)`;
                }
              }
            }
          },
          animation: {
            animateRotate: true,
            animateScale: true,
            duration: 1000,
            easing: 'easeOutQuart'
          }
        }
      });
    }
    
    function emiCalcUpdateChart(principal, interest) {
      if(emiCalcChart) {
        emiCalcChart.data.datasets[0].data = [principal, interest];
        emiCalcChart.update('active');
      }
    }
    
    function emiCalcFormatNumber(num) {
      return new Intl.NumberFormat('en-IN', {maximumFractionDigits:0}).format(Math.round(num));
    }
    
    function emiCalcApplyForLoan() {
      const amount = document.getElementById('emiCalcLoanAmountValue').textContent;
      const emi = document.getElementById('emiCalcResult').textContent;
      if(confirm(`Apply for ₹${amount} loan?\nMonthly EMI is ₹${emi}.\nRedirecting to contact form.`)) {
        const contactSection = document.getElementById('contact');
        if (contactSection) {
          contactSection.scrollIntoView({behavior:'smooth'});
        }
      }
    }
    
    function emiCalcDownloadReport() {
      alert('📊 EMI calculation report will be sent to your email after completing the application form.');
      const contactSection = document.getElementById('contact');
      if (contactSection) {
        contactSection.scrollIntoView({behavior:'smooth'});
      }
    }
    
    // Handle window resize for chart
    window.addEventListener('resize', function() {
      if (emiCalcChart) {
        emiCalcChart.resize();
      }
    });
    
    // Initialize on DOM load
    document.addEventListener('DOMContentLoaded', emiCalcInitCalculator);
  </script>
</section>
