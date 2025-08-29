<section id="eligibility" class="el-check-section">
  <style>
    /* Unique prefixed styles - no root CSS conflicts */
    .el-check-section {
      padding: 8rem 0 6rem 0;
      background: #f8fafc;
      color: #1f2937;
      position: relative;
    }
    .el-check-section::before {
      content: '';
      position: absolute; top: 0; left: 0; right: 0; height: 120px;
      background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
      clip-path: polygon(0 0, 100% 0, 100% 60%, 0 100%);
    }
    .el-check-container {
      max-width: 1250px; margin: 0 auto; padding: 0 2rem; position: relative; z-index: 2;
    }
    .el-check-header {
      text-align: center; margin-bottom: 4rem;
    }
    .el-check-badge {
      background: linear-gradient(135deg, #f59e0b, #d97706);
      color: #fff; padding: 0.75rem 2rem; border-radius: 50px;
      font-size: 0.9rem; font-weight: 600; display: inline-block;
      margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(245,158,11,0.3);
    }
    .el-check-header h2 {
      font-size: clamp(2.5rem, 4vw, 3.5rem); margin-bottom: 1rem; font-weight: 800;
      color: #1f2937; line-height: 1.2;
    }
    .el-check-header p {
      font-size: 1.2rem; color: #6b7280; max-width: 600px;
      margin: 0 auto; line-height: 1.6;
    }
    .el-check-content {
      display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;
    }
    .el-check-info {
      background: #ffffff;
      padding: 3rem; border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      border: 1px solid #e5e7eb;
    }
    .el-check-info-header {
      margin-bottom: 2.5rem;
    }
    .el-check-info-header h3 {
      font-size: 1.8rem; font-weight: 700; color: #1f2937;
      margin-bottom: 1rem;
    }
    .el-check-info-header p {
      color: #6b7280; font-size: 1.1rem; line-height: 1.6;
    }
    .el-check-features {
      list-style: none; margin-bottom: 2.5rem; padding: 0;
    }
    .el-check-features li {
      display: flex; align-items: center; gap: 1rem; margin-bottom: 1.2rem;
      font-size: 1rem; font-weight: 500; color: #1f2937;
      padding: 0.8rem; background: #f8fafc; border-radius: 10px;
      transition: all 0.3s ease;
    }
    .el-check-features li:hover {
      background: #e0f2fe; transform: translateX(5px);
    }
    .el-check-features i {
      color: #f59e0b; font-size: 1.2rem; width: 20px;
    }
    .el-check-calculator {
      background: #ffffff;
      padding: 3rem 2.5rem;
      border-radius: 20px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
      border: 1px solid #e5e7eb;
      position: relative;
    }
    .el-check-calc-header {
      text-align: center; margin-bottom: 2.5rem;
    }
    .el-check-calc-header h3 {
      color: #2563eb; font-size: 1.8rem; margin-bottom: 0.5rem;
      font-weight: 700;
    }
    .el-check-calc-header p {
      color: #6b7280; font-size: 1rem;
    }
    .el-check-form {
      display: grid; gap: 1.5rem;
    }
    .el-check-form-row {
      display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;
    }
    .el-check-input, .el-check-select {
      width: 100%; padding: 1rem; border: 2px solid #e5e7eb;
      border-radius: 10px; font-size: 1rem; color: #1f2937;
      background: #ffffff; font-weight: 500;
      transition: all 0.3s ease;
    }
    .el-check-input::placeholder {
      color: #9ca3af;
    }
    .el-check-input:focus, .el-check-select:focus {
      outline: none; border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }
    .el-check-btn {
      background: linear-gradient(135deg, #2563eb, #1e40af);
      color: #fff; border: none; padding: 1.2rem 2rem; border-radius: 10px;
      font-weight: 700; font-size: 1.1rem; cursor: pointer;
      transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(37,99,235,0.3);
      margin-top: 1rem;
    }
    .el-check-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(37,99,235,0.4);
    }
    .el-check-result {
      background: linear-gradient(135deg, #059669, #047857);
      color: #fff; padding: 2.5rem 2rem; border-radius: 15px;
      margin-top: 2rem; text-align: center; display: none;
      box-shadow: 0 10px 30px rgba(5,150,105,0.3);
    }
    .el-check-result-amount {
      font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;
      color: #fff;
    }
    .el-check-result-details {
      opacity: 0.9; font-size: 1rem; font-weight: 500;
    }
    .el-check-stats {
      display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;
      margin-top: 2rem;
    }
    .el-check-stat-item {
      text-align: center; padding: 1.5rem; background: #f8fafc;
      border-radius: 12px; border: 1px solid #e5e7eb;
    }
    .el-check-stat-number {
      font-size: 1.8rem; font-weight: 800; color: #2563eb;
      display: block; margin-bottom: 0.5rem;
    }
    .el-check-stat-label {
      font-size: 0.9rem; color: #6b7280; font-weight: 500;
    }
    .el-check-process {
      margin-top: 2.5rem;
    }
    .el-check-process h4 {
      font-size: 1.3rem; font-weight: 700; color: #1f2937;
      margin-bottom: 1.5rem;
    }
    .el-check-steps {
      display: grid; gap: 1rem;
    }
    .el-check-step-item {
      display: flex; align-items: center; gap: 1rem;
      padding: 1rem; background: #f8fafc; border-radius: 10px;
    }
    .el-check-step-number {
      width: 30px; height: 30px; background: #2563eb;
      color: #fff; border-radius: 50%; display: flex;
      align-items: center; justify-content: center;
      font-weight: 700; font-size: 0.9rem;
    }
    .el-check-step-text {
      font-weight: 500; color: #1f2937;
    }
    .el-check-animate {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .el-check-animate.visible {
      opacity: 1;
      transform: translateY(0);
    }
    @media(max-width: 1000px) {
      .el-check-content { grid-template-columns: 1fr; gap: 3rem; }
      .el-check-form-row { grid-template-columns: 1fr; }
      .el-check-stats { grid-template-columns: 1fr; }
    }
    @media(max-width: 600px) {
      .el-check-section { padding: 4rem 0; }
      .el-check-info, .el-check-calculator { padding: 2rem 1.5rem; }
      .el-check-header { margin-bottom: 3rem; }
    }
  </style>

  <div class="el-check-container">
    <div class="el-check-header el-check-animate">
      <div class="el-check-badge">📊 Eligibility Check</div>
      <h2>Check Your Loan Eligibility</h2>
      <p>Get instant pre-approval with our advanced eligibility calculator. Know your borrowing capacity in minutes with professional assessment.</p>
    </div>

    <div class="el-check-content">
      <div class="el-check-info el-check-animate">
        <div class="el-check-info-header">
          <h3>Why Check Eligibility?</h3>
          <p>Understanding your loan eligibility helps you make informed financial decisions and streamlines your application process with confidence.</p>
        </div>

        <ul class="el-check-features">
          <li><i class="fas fa-clock"></i> Instant results in 30 seconds</li>
          <li><i class="fas fa-shield-alt"></i> No impact on credit score</li>
          <li><i class="fas fa-calculator"></i> Advanced algorithm analysis</li>
          <li><i class="fas fa-chart-line"></i> Personalized recommendations</li>
          <li><i class="fas fa-lock"></i> 100% secure & confidential</li>
          <li><i class="fas fa-user-tie"></i> Professional assessment</li>
        </ul>

        <div class="el-check-stats">
          <div class="el-check-stat-item">
            <span class="el-check-stat-number">98.7%</span>
            <div class="el-check-stat-label">Approval Rate</div>
          </div>
          <div class="el-check-stat-item">
            <span class="el-check-stat-number">24 Hrs</span>
            <div class="el-check-stat-label">Quick Processing</div>
          </div>
        </div>

        <div class="el-check-process">
          <h4>Simple 3-Step Process</h4>
          <div class="el-check-steps">
            <div class="el-check-step-item">
              <div class="el-check-step-number">1</div>
              <div class="el-check-step-text">Fill basic details accurately</div>
            </div>
            <div class="el-check-step-item">
              <div class="el-check-step-number">2</div>
              <div class="el-check-step-text">Get instant eligibility assessment</div>
            </div>
            <div class="el-check-step-item">
              <div class="el-check-step-number">3</div>
              <div class="el-check-step-text">Apply for loan with confidence</div>
            </div>
          </div>
        </div>
      </div>

      <div class="el-check-calculator el-check-animate">
        <div class="el-check-calc-header">
          <h3><i class="fas fa-calculator"></i> Eligibility Calculator</h3>
          <p>Fill in your details to check your loan eligibility</p>
        </div>

        <form id="elCheckForm" class="el-check-form">
          <div class="el-check-form-row">
            <input type="text" class="el-check-input" name="firstName" placeholder="First Name *" required>
            <input type="text" class="el-check-input" name="lastName" placeholder="Last Name *" required>
          </div>
          
          <input type="email" class="el-check-input" name="email" placeholder="Email Address *" required>
          <input type="tel" class="el-check-input" name="phone" placeholder="Mobile Number *" pattern="[6-9][0-9]{9}" required>
          
          <div class="el-check-form-row">
            <input type="number" class="el-check-input" name="monthlyIncome" placeholder="Monthly Income (₹) *" min="15000" required>
            <input type="number" class="el-check-input" name="monthlyEMI" placeholder="Existing EMIs (₹)" min="0" value="0">
          </div>
          
          <div class="el-check-form-row">
            <select class="el-check-select" name="employmentType" required>
              <option value="">Employment Type *</option>
              <option value="salaried">Salaried Employee</option>
              <option value="self-employed">Self Employed Professional</option>
              <option value="business">Business Owner</option>
              <option value="consultant">Consultant</option>
            </select>
            <input type="number" class="el-check-input" name="experience" placeholder="Work Experience (Years) *" min="1" required>
          </div>
          
          <div class="el-check-form-row">
            <input type="number" class="el-check-input" name="creditScore" placeholder="Credit Score (Optional)" min="300" max="900">
            <select class="el-check-select" name="city" required>
              <option value="">Select City *</option>
              <option value="mumbai">Mumbai</option>
              <option value="delhi">Delhi NCR</option>
              <option value="bangalore">Bangalore</option>
              <option value="pune">Pune</option>
              <option value="hyderabad">Hyderabad</option>
              <option value="chennai">Chennai</option>
              <option value="kolkata">Kolkata</option>
              <option value="ahmedabad">Ahmedabad</option>
              <option value="other">Other</option>
            </select>
          </div>

          <button type="submit" class="el-check-btn">
            <i class="fas fa-search"></i> Check My Eligibility
          </button>
        </form>

        <div id="elCheckResult" class="el-check-result">
          <div class="el-check-result-amount">₹<span id="elCheckAmount">25,00,000</span></div>
          <div class="el-check-result-details">
            Maximum loan amount you're eligible for<br>
            <small>Based on professional assessment of provided information</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function() {
      const form = document.getElementById('elCheckForm');
      const resultDiv = document.getElementById('elCheckResult');
      
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        
        const btn = form.querySelector('.el-check-btn');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Calculating...';
        btn.disabled = true;
        
        setTimeout(() => {
          const eligibility = calculateEligibility(data);
          showResult(eligibility);
          btn.innerHTML = originalText;
          btn.disabled = false;
        }, 1500);
      });
      
      function calculateEligibility(data) {
        const income = parseInt(data.monthlyIncome);
        const existingEMI = parseInt(data.monthlyEMI) || 0;
        const experience = parseInt(data.experience);
        const creditScore = parseInt(data.creditScore) || 750;
        
        let multiplier = 50;
        
        if (data.employmentType === 'salaried') multiplier += 10;
        else if (data.employmentType === 'business') multiplier += 8;
        else if (data.employmentType === 'consultant') multiplier += 6;
        
        if (experience >= 5) multiplier += 5;
        if (experience >= 10) multiplier += 5;
        if (creditScore >= 750) multiplier += 5;
        if (creditScore >= 800) multiplier += 5;
        
        const tier1Cities = ['mumbai', 'delhi', 'bangalore', 'pune', 'hyderabad', 'chennai'];
        if (tier1Cities.includes(data.city)) multiplier += 5;
        
        const availableIncome = income - existingEMI;
        const maxEMI = availableIncome * 0.5;
        const rate = 8.5 / 12 / 100;
        const tenure = 20 * 12;
        const loanAmount = (maxEMI * (Math.pow(1 + rate, tenure) - 1)) / (rate * Math.pow(1 + rate, tenure));
        
        return Math.min(loanAmount, income * multiplier);
      }
      
      function showResult(amount) {
        const formattedAmount = Math.round(amount / 100000) * 100000;
        document.getElementById('elCheckAmount').textContent = formatNumber(formattedAmount);
        resultDiv.style.display = 'block';
        resultDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      
      function formatNumber(num) {
        return new Intl.NumberFormat('en-IN', {maximumFractionDigits: 0}).format(num);
      }
      
      // Scroll animations
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
          }
        });
      }, { threshold: 0.1 });
      
      document.querySelectorAll('.el-check-animate').forEach(el => {
        observer.observe(el);
      });
    })();
  </script>
</section>
