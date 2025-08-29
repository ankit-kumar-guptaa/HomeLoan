<section id="process" class="process-section py-5">
  <style>
    .process-section {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
      color: #1e293b;
      position: relative;
      overflow: hidden;
    }
    
    .process-bg-pattern {
      position: absolute;
      top: -50px;
      left: -50px;
      width: 200px;
      height: 200px;
      background: radial-gradient(circle, rgba(59,130,246,0.05) 0%, transparent 70%);
      border-radius: 50%;
    }
    
    .process-bg-pattern-2 {
      position: absolute;
      bottom: -50px;
      right: -50px;
      width: 150px;
      height: 150px;
      background: radial-gradient(circle, rgba(245,158,11,0.05) 0%, transparent 70%);
      border-radius: 50%;
    }
    
    .section-badge {
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
    
    .process-title {
      color: #1e293b;
      font-weight: 800;
      margin-bottom: 1rem;
    }
    
    .process-subtitle {
      color: #64748b;
      font-size: 1.1rem;
      max-width: 600px;
    }
    
    .process-card {
      background: #ffffff;
      border-radius: 16px;
      padding: 2rem 1.5rem;
      box-shadow: 0 8px 30px rgba(0,0,0,0.08);
      border: 1px solid #e2e8f0;
      position: relative;
      text-align: center;
      transition: all 0.3s ease;
      height: 100%;
    }
    
    .process-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }
    
    .step-number {
      position: absolute;
      top: -15px;
      left: 50%;
      transform: translateX(-50%);
      width: 30px;
      height: 30px;
      background: linear-gradient(135deg, #f59e0b, #d97706);
      color: #fff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      font-weight: 700;
      border: 3px solid #fff;
      box-shadow: 0 4px 15px rgba(245,158,11,0.3);
    }
    
    .step-icon-wrapper {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 1.5rem auto 1.5rem;
      font-size: 1.8rem;
      color: #fff;
      box-shadow: 0 8px 25px rgba(59,130,246,0.2);
      transition: all 0.3s ease;
    }
    
    .process-card:hover .step-icon-wrapper {
      transform: scale(1.1);
      box-shadow: 0 12px 35px rgba(59,130,246,0.3);
    }
    
    .step-title {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 1rem;
    }
    
    .step-desc {
      color: #64748b;
      line-height: 1.6;
      margin-bottom: 1rem;
      font-size: 0.95rem;
    }
    
    .step-time {
      background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(245,158,11,0.05));
      color: #d97706;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      display: inline-block;
      border: 1px solid rgba(245,158,11,0.2);
    }
    
    /* Connection Line for Desktop */
    .process-connection {
      position: relative;
    }
    
    .process-connection::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, transparent 10%, #e2e8f0 20%, #3b82f6 50%, #e2e8f0 80%, transparent 90%);
      z-index: 1;
      transform: translateY(-50%);
    }
    
    .process-card {
      position: relative;
      z-index: 2;
    }
    
    /* Animations */
    .animate-fade-up {
      opacity: 0;
      transform: translateY(30px);
      animation: fadeUp 0.8s ease-out forwards;
    }
    
    .animate-fade-up:nth-child(1) { animation-delay: 0.1s; }
    .animate-fade-up:nth-child(2) { animation-delay: 0.2s; }
    .animate-fade-up:nth-child(3) { animation-delay: 0.3s; }
    .animate-fade-up:nth-child(4) { animation-delay: 0.4s; }
    
    @keyframes fadeUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Mobile Styles */
    @media (max-width: 767.98px) {
      .process-connection::after {
        display: none;
      }
      
      .step-icon-wrapper {
        width: 70px;
        height: 70px;
        font-size: 1.5rem;
      }
      
      .process-card {
        margin-bottom: 2rem;
        padding: 1.5rem;
      }
      
      .step-title {
        font-size: 1.1rem;
      }
      
      .step-desc {
        font-size: 0.9rem;
      }
    }
  </style>

  <!-- Background Patterns -->
  <div class="process-bg-pattern"></div>
  <div class="process-bg-pattern-2"></div>

  <div class="container position-relative">
    <!-- Header -->
    <div class="row">
      <div class="col-12">
        <div class="text-center mb-5">
          <div class="section-badge">🚀 Process Overview</div>
          <h2 class="display-5 process-title">Simple 4-Step Process</h2>
          <p class="process-subtitle mx-auto">From application to approval - experience the smoothest home loan journey with complete transparency</p>
        </div>
      </div>
    </div>

    <!-- Process Steps -->
    <div class="row process-connection">
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="process-card animate-fade-up">
          <div class="step-number">1</div>
          <div class="step-icon-wrapper">
            <i class="fas fa-file-alt"></i>
          </div>
          <h3 class="step-title">Apply Online</h3>
          <p class="step-desc">Fill our simple online form with basic details. Get instant pre-approval status within minutes.</p>
          <div class="step-time">⏱️ 5 Minutes</div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="process-card animate-fade-up">
          <div class="step-number">2</div>
          <div class="step-icon-wrapper">
            <i class="fas fa-search"></i>
          </div>
          <h3 class="step-title">Document Verification</h3>
          <p class="step-desc">Our experts guide you through document submission. Upload digitally or visit our office.</p>
          <div class="step-time">⏱️ 24 Hours</div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="process-card animate-fade-up">
          <div class="step-number">3</div>
          <div class="step-icon-wrapper">
            <i class="fas fa-check-circle"></i>
          </div>
          <h3 class="step-title">Approval & Sanction</h3>
          <p class="step-desc">Get final approval with sanction letter. Property valuation and legal clearance completed.</p>
          <div class="step-time">⏱️ 3-5 Days</div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="process-card animate-fade-up">
          <div class="step-number">4</div>
          <div class="step-icon-wrapper">
            <i class="fas fa-key"></i>
          </div>
          <h3 class="step-title">Loan Disbursement</h3>
          <p class="step-desc">Complete formalities and get your loan disbursed. Receive your dream home keys instantly!</p>
          <div class="step-time">⏱️ 1-2 Days</div>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="text-center">
          <div class="bg-white rounded-3 p-4 shadow-sm d-inline-block">
            <h5 class="mb-3 text-dark fw-bold">Ready to Start Your Home Loan Journey?</h5>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
              <a href="#home" class="btn btn-primary px-4 py-2">
                <i class="fas fa-rocket me-2"></i>Apply Now
              </a>
              <a href="#calculator" class="btn btn-outline-primary px-4 py-2">
                <i class="fas fa-calculator me-2"></i>Calculate EMI
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Intersection Observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.animationPlayState = 'running';
        }
      });
    }, observerOptions);

    // Observe all animate elements
    document.addEventListener('DOMContentLoaded', function() {
      const animateElements = document.querySelectorAll('.animate-fade-up');
      animateElements.forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
      });
    });

    // Add hover effects for better interactivity
    document.querySelectorAll('.process-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.borderColor = '#3b82f6';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.borderColor = '#e2e8f0';
      });
    });
  </script>
</section>
