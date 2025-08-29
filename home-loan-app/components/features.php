<section id="features" class="features-section py-5">
  <style>
    .features-section {
      background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #ffffff 100%);
      position: relative;
      overflow: hidden;
    }
    
    .features-bg-pattern {
      position: absolute;
      top: 20%;
      left: -100px;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(59,130,246,0.03) 0%, transparent 70%);
      border-radius: 50%;
    }
    
    .features-bg-pattern-2 {
      position: absolute;
      bottom: 20%;
      right: -100px;
      width: 250px;
      height: 250px;
      background: radial-gradient(circle, rgba(245,158,11,0.03) 0%, transparent 70%);
      border-radius: 50%;
    }
    
    .section-badge {
      background: linear-gradient(135deg, #f59e0b, #d97706);
      color: #fff;
      padding: 0.6rem 1.5rem;
      border-radius: 25px;
      font-size: 0.9rem;
      font-weight: 600;
      display: inline-block;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 15px rgba(245,158,11,0.3);
    }
    
    .features-title {
      color: #1e293b;
      font-weight: 800;
      margin-bottom: 1rem;
    }
    
    .features-subtitle {
      color: #64748b;
      font-size: 1.1rem;
      max-width: 700px;
    }
    
    .feature-card {
      background: #ffffff;
      border-radius: 16px;
      padding: 2rem 1.5rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.06);
      border: 1px solid #e2e8f0;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      text-align: center;
      height: 100%;
      position: relative;
      overflow: hidden;
    }
    
    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #3b82f6, #1d4ed8);
      transform: translateX(-100%);
      transition: transform 0.4s ease;
    }
    
    .feature-card:hover::before {
      transform: translateX(0);
    }
    
    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.12);
      border-color: rgba(59,130,246,0.2);
    }
    
    .feature-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      font-size: 1.5rem;
      color: #fff;
      box-shadow: 0 8px 25px rgba(59,130,246,0.2);
      transition: all 0.3s ease;
      position: relative;
    }
    
    .feature-card:hover .feature-icon {
      transform: scale(1.1) rotate(5deg);
      box-shadow: 0 12px 35px rgba(59,130,246,0.3);
    }
    
    .feature-title {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 1rem;
      transition: color 0.3s ease;
    }
    
    .feature-card:hover .feature-title {
      color: #3b82f6;
    }
    
    .feature-desc {
      color: #64748b;
      line-height: 1.6;
      font-size: 0.95rem;
      margin: 0;
    }
    
    /* Special styling for different icons */
    .feature-card:nth-child(1) .feature-icon {
      background: linear-gradient(135deg, #f59e0b, #d97706);
      box-shadow: 0 8px 25px rgba(245,158,11,0.2);
    }
    
    .feature-card:nth-child(1):hover .feature-icon {
      box-shadow: 0 12px 35px rgba(245,158,11,0.3);
    }
    
    .feature-card:nth-child(1)::before {
      background: linear-gradient(90deg, #f59e0b, #d97706);
    }
    
    .feature-card:nth-child(3) .feature-icon {
      background: linear-gradient(135deg, #10b981, #059669);
      box-shadow: 0 8px 25px rgba(16,185,129,0.2);
    }
    
    .feature-card:nth-child(3):hover .feature-icon {
      box-shadow: 0 12px 35px rgba(16,185,129,0.3);
    }
    
    .feature-card:nth-child(3)::before {
      background: linear-gradient(90deg, #10b981, #059669);
    }
    
    .feature-card:nth-child(5) .feature-icon {
      background: linear-gradient(135deg, #8b5cf6, #7c3aed);
      box-shadow: 0 8px 25px rgba(139,92,246,0.2);
    }
    
    .feature-card:nth-child(5):hover .feature-icon {
      box-shadow: 0 12px 35px rgba(139,92,246,0.3);
    }
    
    .feature-card:nth-child(5)::before {
      background: linear-gradient(90deg, #8b5cf6, #7c3aed);
    }
    
    .feature-card:nth-child(7) .feature-icon {
      background: linear-gradient(135deg, #ef4444, #dc2626);
      box-shadow: 0 8px 25px rgba(239,68,68,0.2);
    }
    
    .feature-card:nth-child(7):hover .feature-icon {
      box-shadow: 0 12px 35px rgba(239,68,68,0.3);
    }
    
    .feature-card:nth-child(7)::before {
      background: linear-gradient(90deg, #ef4444, #dc2626);
    }
    
    /* Animations */
    .animate-fade-in {
      opacity: 0;
      transform: translateY(30px);
      animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .animate-fade-in:nth-child(1) { animation-delay: 0.1s; }
    .animate-fade-in:nth-child(2) { animation-delay: 0.15s; }
    .animate-fade-in:nth-child(3) { animation-delay: 0.2s; }
    .animate-fade-in:nth-child(4) { animation-delay: 0.25s; }
    .animate-fade-in:nth-child(5) { animation-delay: 0.3s; }
    .animate-fade-in:nth-child(6) { animation-delay: 0.35s; }
    .animate-fade-in:nth-child(7) { animation-delay: 0.4s; }
    .animate-fade-in:nth-child(8) { animation-delay: 0.45s; }
    
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Responsive */
    @media (max-width: 767.98px) {
      .feature-icon {
        width: 60px;
        height: 60px;
        font-size: 1.3rem;
      }
      
      .feature-card {
        padding: 1.5rem;
      }
      
      .feature-title {
        font-size: 1.1rem;
      }
      
      .feature-desc {
        font-size: 0.9rem;
      }
    }
  </style>

  <!-- Background Patterns -->
  <div class="features-bg-pattern"></div>
  <div class="features-bg-pattern-2"></div>

  <div class="container position-relative">
    <!-- Header -->
    <div class="row">
      <div class="col-12">
        <div class="text-center mb-5">
          <div class="section-badge">⭐ Why Choose Us</div>
          <h2 class="display-5 features-title">Unmatched Excellence in Home Loans</h2>
          <p class="features-subtitle mx-auto">Experience the difference with our comprehensive range of benefits designed to make your home buying journey smooth and hassle-free</p>
        </div>
      </div>
    </div>

    <!-- Features Grid - 8 Points -->
    <div class="row g-4">
      <div class="col-12 col-md-6 col-lg-3">
        <div class="feature-card animate-fade-in">
          <div class="feature-icon">
            <i class="fas fa-clock"></i>
          </div>
          <h3 class="feature-title">Quick Approval</h3>
          <p class="feature-desc">Get loan approval within 24-48 hours with minimal paperwork and swift processing.</p>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="feature-card animate-fade-in">
          <div class="feature-icon">
            <i class="fas fa-percentage"></i>
          </div>
          <h3 class="feature-title">Competitive Rates</h3>
          <p class="feature-desc">Enjoy the lowest interest rates starting from 8.5% and save more throughout your loan tenure.</p>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="feature-card animate-fade-in">
          <div class="feature-icon">
            <i class="fas fa-user-tie"></i>
          </div>
          <h3 class="feature-title">Dedicated Manager</h3>
          <p class="feature-desc">Personal relationship manager as your single point of contact until loan disbursement.</p>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="feature-card animate-fade-in">
          <div class="feature-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3 class="feature-title">Data Security</h3>
          <p class="feature-desc">Bank-grade encryption and complete data protection with 100% privacy compliance.</p>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="feature-card animate-fade-in">
          <div class="feature-icon">
            <i class="fas fa-award"></i>
          </div>
          <h3 class="feature-title">15 Years Experience</h3>
          <p class="feature-desc">Trusted by 10,000+ happy families since 2010 with proven track record of excellence.</p>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="feature-card animate-fade-in">
          <div class="feature-icon">
            <i class="fas fa-mobile-alt"></i>
          </div>
          <h3 class="feature-title">Digital Process</h3>
          <p class="feature-desc">100% paperless application with digital document upload and online tracking facility.</p>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="feature-card animate-fade-in">
          <div class="feature-icon">
            <i class="fas fa-handshake"></i>
          </div>
          <h3 class="feature-title">Zero Hidden Charges</h3>
          <p class="feature-desc">Complete transparency with no hidden fees or processing charges. What you see is what you pay.</p>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <div class="feature-card animate-fade-in">
          <div class="feature-icon">
            <i class="fas fa-headset"></i>
          </div>
          <h3 class="feature-title">24/7 Support</h3>
          <p class="feature-desc">Round-the-clock customer support with expert guidance at every step of your loan journey.</p>
        </div>
      </div>
    </div>

    <!-- Trust Indicators -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="text-center">
          <div class="bg-light rounded-3 p-4">
            <div class="row align-items-center">
              <div class="col-12 col-md-3 mb-3 mb-md-0">
                <h4 class="text-primary mb-1 fw-bold">10,000+</h4>
                <small class="text-muted">Happy Customers</small>
              </div>
              <div class="col-12 col-md-3 mb-3 mb-md-0">
                <h4 class="text-success mb-1 fw-bold">₹500+ Cr</h4>
                <small class="text-muted">Loans Disbursed</small>
              </div>
              <div class="col-12 col-md-3 mb-3 mb-md-0">
                <h4 class="text-warning mb-1 fw-bold">98.5%</h4>
                <small class="text-muted">Approval Rate</small>
              </div>
              <div class="col-12 col-md-3">
                <h4 class="text-info mb-1 fw-bold">4.9/5</h4>
                <small class="text-muted">Customer Rating</small>
              </div>
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

    // Initialize animations
    document.addEventListener('DOMContentLoaded', function() {
      const animateElements = document.querySelectorAll('.animate-fade-in');
      animateElements.forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
      });
    });

    // Enhanced hover effects
    document.querySelectorAll('.feature-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.borderColor = 'rgba(59,130,246,0.3)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.borderColor = '#e2e8f0';
      });
    });
  </script>
</section>
