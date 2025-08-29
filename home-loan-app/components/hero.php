<section id="home" class="hero-section">
  <style>
    .hero-section {
      min-height: 100vh;
      background: #1a1a1a;
      position: relative;
      display: flex;
      align-items: center;
      overflow: hidden;
    }
    
    .hero-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }
    
    .hero-bg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      filter: brightness(0.9) contrast(1.1);
    }
    
    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, 
        rgba(0,0,0,0.85) 0%, 
        rgba(0,0,0,0.75) 50%, 
        rgba(0,0,0,0.3) 75%, 
        transparent 100%
      );
      z-index: 1;
    }
    
    .hero-content {
      position: relative;
      z-index: 2;
      color: #fff;
      animation: fadeInUp 1s ease-out;
    }
    
    .hero-divider {
      width: 90px;
      height: 4px;
      background: linear-gradient(90deg, #00bfff, #1e90ff);
      margin-bottom: 2rem;
      border-radius: 2px;
      animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
      from { box-shadow: 0 0 5px #00bfff; }
      to { box-shadow: 0 0 20px #00bfff, 0 0 30px #00bfff; }
    }
    
    .hero-title {
      font-size: clamp(2.5rem, 5vw, 4.2rem);
      font-weight: 900;
      line-height: 1.1;
      margin-bottom: 2rem;
      color: #fff;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
    }
    
    .hero-subtitle {
      font-size: 1.4rem;
      color: #00bfff;
      font-weight: 600;
      margin-bottom: 1.5rem;
      letter-spacing: 0.5px;
    }
    
    .hero-features {
      font-size: 1.1rem;
      color: #00bfff;
      font-weight: 500;
      line-height: 1.4;
      letter-spacing: 0.3px;
    }
    
    .hero-form-container {
      background: #fff;
      border-radius: 16px;
      padding: 2rem;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
      position: relative;
      z-index: 2;
      animation: slideInRight 1s ease-out 0.6s both;
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
    
    .hero-form-title {
      font-size: 1.3rem;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 1.5rem;
    }
    
    .loan-type-label {
      font-size: 0.9rem;
      color: #6b7280;
      margin-bottom: 0.8rem;
      font-weight: 500;
    }
    
    .loan-type-buttons {
      display: flex;
      gap: 0.5rem;
      margin-bottom: 1.5rem;
    }
    
    .loan-type-btn {
      flex: 1;
      padding: 0.7rem 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 25px;
      background: #fff;
      color: #6b7280;
      font-weight: 500;
      font-size: 0.85rem;
      cursor: pointer;
      text-align: center;
      transition: all 0.3s ease;
    }
    
    .loan-type-btn.active {
      background: #1a1a1a;
      color: #fff;
      border-color: #1a1a1a;
    }
    
    .form-label {
      font-size: 0.75rem;
      font-weight: 600;
      color: #6b7280;
      margin-bottom: 0.5rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .form-control {
      padding: 0.8rem;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 0.9rem;
      color: #1f2937;
      background: #fff;
      transition: border-color 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #00bfff;
      box-shadow: 0 0 0 3px rgba(0,191,255,0.1);
    }
    
    .loan-info {
      color: #00bfff;
      font-size: 0.85rem;
      font-weight: 500;
      margin: 1rem 0;
    }
    
    .hero-submit-btn {
      background: #00bfff;
      color: #fff;
      border: none;
      padding: 0.9rem 2rem;
      border-radius: 25px;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      width: auto;
      margin-left: auto;
      display: block;
    }
    
    .hero-submit-btn:hover {
      background: #0099cc;
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(0,191,255,0.4);
    }
    
    @media (max-width: 991.98px) {
      .hero-form-container {
        margin-top: 3rem;
        max-width: 500px;
      }
      
      .hero-content {
        text-align: center;
        margin-bottom: 2rem;
      }
    }
    
    @media (max-width: 767.98px) {
      .loan-type-buttons {
        flex-direction: column;
      }
      
      .hero-title {
        font-size: clamp(2rem, 8vw, 3rem);
      }
    }
  </style>

  <!-- Background Image -->
  <div class="hero-bg">
    <img src="/assets/images/hero.png" alt="Happy family with home loan advisor"/>

  </div>
  <div class="hero-overlay"></div>

  <div class="container">
    <div class="row align-items-center">
      <!-- Left Content -->
      <div class="col-12 col-lg-7">
        <div class="hero-content">
          <!-- Glowing Divider -->
          <div class="hero-divider"></div>
          
          <!-- Main Title -->
          <h1 class="hero-title">
            Your Home, Your Terms<br>
            Home Loan Ka<br>
            SwayamGhar!
          </h1>
          
          <!-- Subtitle -->
          <div class="hero-subtitle">Fast, Hassle-Free Home Loans</div>
          
          <!-- Features -->
          <div class="hero-features">
            Best Interest Rates | Quick Eligibility Check | EMI Calculator |<br>
            End-To-End Agent Support
          </div>
        </div>
      </div>

      <!-- Right Form -->
      <div class="col-12 col-lg-5">
        <div class="hero-form-container mx-auto">
          <div class="text-center">
            <h2 class="hero-form-title">Tell us about your requirements</h2>
            
            <!-- Loan Type Selection -->
            <div class="text-start">
              <div class="loan-type-label">Select Your Loan Type</div>
              <div class="loan-type-buttons">
                <div class="loan-type-btn active" data-type="home">HOME LOAN</div>
                <div class="loan-type-btn" data-type="lap">LOAN AGAINST PROPERTY</div>
              </div>
            </div>
          </div>

          <form id="heroForm">
            <!-- Name Fields -->
            <div class="row">
              <div class="col-6">
                <label class="form-label">FIRST NAME *</label>
                <input type="text" class="form-control" name="firstName" required>
              </div>
              <div class="col-6">
                <label class="form-label">LAST NAME *</label>
                <input type="text" class="form-control" name="lastName" required>
              </div>
            </div>

            <!-- Contact Fields -->
            <div class="row mt-3">
              <div class="col-6">
                <label class="form-label">EMAIL ID *</label>
                <input type="email" class="form-control" name="email" required>
              </div>
              <div class="col-6">
                <label class="form-label">CONTACT NUMBER *</label>
                <input type="tel" class="form-control" name="phone" pattern="[6-9][0-9]{9}" required>
              </div>
            </div>

            <!-- Loan Details -->
            <div class="row mt-3">
              <div class="col-6">
                <label class="form-label">LOAN AMOUNT *</label>
                <input type="number" class="form-control" name="loanAmount" min="100000" step="50000" required>
              </div>
              <div class="col-6">
                <label class="form-label">PROPERTY PINCODE *</label>
                <input type="text" class="form-control" name="pincode" pattern="[0-9]{6}" required>
              </div>
            </div>

            <!-- Loan Info -->
            <div class="loan-info">
              Min. Loan Amount - 30 Lacs
            </div>

            <!-- Submit Button -->
            <button type="submit" class="hero-submit-btn">NEXT</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Loan type selection
    document.querySelectorAll('.loan-type-btn').forEach(button => {
      button.addEventListener('click', function() {
        document.querySelectorAll('.loan-type-btn').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
      });
    });

    // Form submission
    document.getElementById('heroForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const submitBtn = this.querySelector('.hero-submit-btn');
      const originalText = submitBtn.textContent;
      
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>PROCESSING...';
      submitBtn.disabled = true;
      
      setTimeout(() => {
        submitBtn.innerHTML = '✅ SUCCESS!';
        submitBtn.style.background = '#10b981';
        
        setTimeout(() => {
          // Bootstrap Modal or Alert
          if (typeof bootstrap !== 'undefined') {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success alert-dismissible fade show position-fixed';
            alertDiv.style.cssText = 'top: 100px; right: 20px; z-index: 9999; max-width: 400px;';
            alertDiv.innerHTML = `
              <strong>🎉 Success!</strong> Our loan expert will contact you within 30 minutes.
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
              if (alertDiv.parentNode) {
                alertDiv.parentNode.removeChild(alertDiv);
              }
            }, 5000);
          } else {
            alert('🎉 Thank you! Our loan expert will contact you within 30 minutes.');
          }
          
          this.reset();
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
          submitBtn.style.background = '';
          
          // Reset loan type selection
          document.querySelectorAll('.loan-type-btn').forEach(btn => btn.classList.remove('active'));
          document.querySelector('.loan-type-btn[data-type="home"]').classList.add('active');
        }, 1500);
      }, 2000);
    });

    // Parallax effect
    window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      const bg = document.querySelector('.hero-bg img');
      if (bg) {
        bg.style.transform = `translateY(${scrolled * 0.5}px)`;
      }
    }, { passive: true });
  </script>
</section>
