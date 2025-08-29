<section id="services" class="services">
  <style>
    :root {
      --primary: #1E3A8A;
      --secondary: #3730A3;
      --accent: #F59E0B;
      --glass: rgba(255,255,255,0.15);
    }
    .services {
      position: relative;
      padding: 8rem 0 5rem 0;
      background:
        linear-gradient(160deg,#f8fafc 0%,#e2e8f0 80%,#fff 100%);
      overflow: hidden;
    }
    .services-bg-float {
      position: absolute; top:2%; left:5%; opacity:0.10; width:160px; height:160px;
      background: radial-gradient(ellipse at center,#1E3A8A 60%,transparent 100%);
      border-radius:50%; z-index:0;
      animation: floatBg1 16s ease-in-out infinite;
    }
    .services-bg-line {
      position: absolute; bottom:10%; right:3%; z-index:0;
      width:220px; height:60px; opacity:0.09;
      background: linear-gradient(90deg,#F59E0B 50%,#1e3a8a 100%);
      border-radius:30px;
      filter:blur(3px);
      animation: floatBg2 18s ease-in-out infinite;
    }
    @keyframes floatBg1 {
      0%,100% {transform:translateY(0);}
      40% {transform:translateY(-30px);}
    }
    @keyframes floatBg2 {
      0%,100% {transform:translateY(0);}
      55% {transform:translateY(38px);}
    }
    .services-container { position:relative; z-index:2; max-width:1480px; margin:0 auto; padding:0 2rem;}
    .section-header { text-align:center; margin-bottom:5rem; position:relative; }
    .section-badge {
      background: linear-gradient(120deg, #F59E0B, #D97706 80%);
      color: #fff;
      padding: 0.9rem 2.1rem;
      border-radius: 3rem;
      font-size: 1rem;
      font-weight: 700;
      display: inline-block;
      margin-bottom:1.7rem;
      box-shadow:0 4px 18px rgba(245,158,11,0.19);
      letter-spacing: 0.4px;
    }
    .services h2 {
      font-size:clamp(2.9rem,4vw,4.2rem);
      font-weight:900;
      margin-bottom:1.5rem;
      background: linear-gradient(90deg, #0f172a, #1E3A8A 80%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    .services .subtitle {
      font-size:1.27rem;
      color:#4b5563;
      max-width:720px;
      margin:0 auto;
      line-height:1.65;
    }
    /*  --- Grid --- */
    .services-grid {
      display: grid;
      grid-template-columns:repeat(2,1fr);
      gap:3.1rem;
      margin-bottom:4.5rem;
    }
    /*  --- Card --- */
    .service-card {
      position:relative;
      background:var(--glass);
      border-radius:32px;
      padding:3.1rem 3rem 3rem 3rem;
      box-shadow:0 18px 44px rgba(30,58,138,0.1);
      border:1.5px solid rgba(30,58,138,0.09);
      backdrop-filter:blur(13px);
      display:flex;flex-direction:column;align-items:flex-start;
      transition:transform .5s cubic-bezier(.43,.12,.32,1), box-shadow .5s cubic-bezier(.43,.12,.32,1);
      overflow:hidden;
      z-index:1;
      min-height:430px;
    }
    .service-card::after {
      content:"";
      position:absolute;
      top:-80px;right:-80px;
      width:160px;height:160px;
      background:radial-gradient(ellipse at center, #F59E0B 60%, transparent 100%);
      border-radius:50%;
      z-index:0;
      opacity:0.14;
      filter:blur(14px);
    }
    .service-card .service-icon {
      position:relative;
      z-index:2;
      width:88px;height:88px;
      border-radius:24px;
      background:linear-gradient(120deg,#1E3A8A,#3730A3 90%);
      display:flex;align-items:center;justify-content:center;
      margin-bottom:2.4rem;
      box-shadow:0 8px 60px 0 rgba(30,58,138,0.14);
      transition:.4s;
    }
    .service-card .service-icon i { color:#fff; font-size:2.3rem;}
    .service-card:hover {transform:translateY(-11px) scale(1.02); box-shadow:0 32px 84px rgba(30,58,138,0.13);}
    .service-card:hover .service-icon {background:linear-gradient(120deg,#F59E0B,#1E3A8A);}
    .service-card h3 {
      font-size:1.45rem;
      color:#111827;
      margin-bottom:1.1rem;
      font-weight:800;
      position:relative;
      z-index:2;
    }
    .service-card h3::after {
      content:"";
      display:block;
      margin:.2rem 0 0;
      width:44px;height:3.5px;
      border-radius:2px;
      background:linear-gradient(90deg,#F59E0B,#1E3A8A);
      opacity:.7;
    }
    .service-card p {
      color:#636a7c;
      font-size:1.09rem;
      margin-bottom:2.1rem;
      line-height:1.85;
      position:relative;z-index:2;
    }
    .service-features {
      list-style:none;
      margin-bottom:2.1rem;
      padding:0;
      position:relative;
      z-index:2;
    }
    .service-features li {
      display:flex;align-items:center;gap:.8rem;
      font-size:1rem;
      margin-bottom:0.7rem;
      color:#395586;
      font-weight:500;
      transition:.26s;
      letter-spacing:0.01em;
      border-left:3.5px solid #e2e8f0;
      padding-left:.7rem;
    }
    .service-features li:hover {
      color:#1E3A8A;
      border-left:3.5px solid #F59E0B;
      background:rgba(245,158,11,0.08);
    }
    .service-features i {color:#10b981;font-size:1.18rem;width:22px;}
    .service-cta {
      position:relative;z-index:2;
      background:linear-gradient(135deg,#fff,#e2e8f0 75%);
      color:var(--primary);
      padding:0.85rem 2rem;border-radius:14px;
      text-decoration:none;font-weight:700;
      transition:.45s;
      display:inline-flex;align-items:center;gap:0.7rem;
      box-shadow:0 2px 11px rgba(30,58,138,0.08);
      letter-spacing: 0.03em;
    }
    .service-cta:hover {
      background:linear-gradient(120deg,#1E3A8A,#3730A3 75%);
      color:#fff;transform:translateY(-2px) scale(1.05);
      box-shadow:0 10px 40px rgba(30,58,138,0.09);
    }
    /*  --- Stats Banner --- */
    .stats-banner {
      margin-top:5rem;
      background:linear-gradient(120deg,#1E3A8A 70%,#3730A3 100%);
      color:#fff;
      border-radius:33px;
      padding:4.2rem 2.5rem;
      position:relative;
      overflow:hidden;
      box-shadow:0 15px 50px rgba(30,58,138,0.09);
    }
    .stats-banner::before {
      content:"";
      position:absolute;top:-30px;right:-30px;
      width:310px;height:300px;
      background:url('https://images.unsplash.com/photo-1560472354-b33ff0c44a43?auto=format&fit=crop&w=800&q=80') center/cover;
      border-radius:55%;opacity:.11;
      filter:blur(3.5px);
    }
    .stats-grid {
      position:relative;z-index:2;
      display:grid;
      grid-template-columns:repeat(4,1fr);
      gap:2.7rem;text-align:center;
    }
    .stat-item {padding:1.2rem;}
    .stat-number {
      font-size:2.5rem;
      font-weight:800;
      color:#F59E0B;
      margin-bottom:0.66rem;
      background:linear-gradient(90deg,#F59E0B,#FCD34D);
      -webkit-background-clip:text;
      background-clip:text;
      color:transparent;
    }
    .stat-label {
      font-weight:700;
      font-size:1.08rem;
      margin-bottom:0.17rem;
      letter-spacing:.03em;
      color:#fff;}
    .stat-description {
      font-size:.98rem;
      opacity:0.8;
      color:#e2e8f0;
    }
    /* ---- Floating service icons decoration ---- */
    .services-float-icons {
      position:absolute;
      left:1%;
      top:12%;
      z-index:1;
      pointer-events:none;
      display:flex;
      flex-direction:column;
      gap:3.2rem;
    }
    .float-icon {font-size:2.6rem;color:var(--accent);opacity:0.16;animation:floatIcon 6s infinite alternate;}
    .float-icon:nth-child(2) {animation-delay:1.2s;}
    .float-icon:nth-child(3) {animation-delay:2.2s;}
    @keyframes floatIcon {
      0%{transform:translateY(0)}
      100%{transform:translateY(24px)}
    }
    /* --- Responsive --- */
    @media(max-width:1080px){.services-grid{grid-template-columns:1fr}}
    @media(max-width:950px){
      .stats-grid{grid-template-columns:repeat(2,1fr);}
      .stats-banner{padding:2.7rem 1rem;}
      .services-container{padding:0 1rem;}
      .service-card{padding:2.4rem 1.2rem;}
    }
    @media(max-width:600px){
      .stats-grid{grid-template-columns:1fr;}
      .stats-banner{padding:1.3rem .4rem;}
      .service-card{padding:2rem .6rem;}
      .services{padding:5rem 0 2.5rem 0;}
      .section-header{margin-bottom:3rem;}
      .service-card{min-height:370px;}
    }
  </style>

  <!-- Decorative floats -->
  <div class="services-bg-float"></div>
  <div class="services-bg-line"></div>
  <div class="services-float-icons">
    <span class="float-icon"><i class="fas fa-home"></i></span>
    <span class="float-icon"><i class="fas fa-tools"></i></span>
    <span class="float-icon"><i class="fas fa-sync-alt"></i></span>
    <span class="float-icon"><i class="fas fa-building"></i></span>
  </div>

  <div class="services-container">
    <div class="section-header">
      <div class="section-badge">🏠 Our Services</div>
      <h2>Discover Home Loan Excellence</h2>
      <p class="subtitle">From your first address to your next investment. Unlock smarter, faster, and more rewarding home loan solutions—backed by creativity and care since 2010.</p>
    </div>
    <div class="services-grid">
    <?php
      $services = [
        [
          'icon' => 'fas fa-home',
          'title' => 'Home Purchase Loans',
          'description' => 'Make your first move! Fast-track your dream home journey with 90% financing, no hidden fees, and expert guidance throughout.',
          'features' => [
            'Up to ₹5 Crores loan',
            'Competitive 8.5% rates',
            'Repayment tenure up to 30 years',
            'Zero prepayment penalty after 1 year',
            'Get eligibility in under 2 hours'
          ]
        ],
        [
          'icon' => 'fas fa-tools',
          'title' => 'Home Construction Loans',
          'description' => 'Build it your way. Get stage-wise fund release, technical support, and a seamless switch to a regular home loan once completed.',
          'features' => [
            'Stage-wise disbursement',
            'Project monitoring by experts',
            'Flexible payment options',
            'Easy loan conversion',
            'Tech guidance for stress-free building'
          ]
        ],
        [
          'icon' => 'fas fa-sync-alt',
          'title' => 'Balance Transfer & Top-up',
          'description' => 'Switch & save with us! Transfer your loan for lower EMIs and get extra top-up for home upgrades, education, or any major goals.',
          'features' => [
            'Save up to ₹10 Lakhs interest',
            'Top-up up to ₹3 Crores',
            'Minimal charges on processing',
            'Fast transfer in 15 days',
            'Retain your existing insurance cover'
          ]
        ],
        [
          'icon' => 'fas fa-building',
          'title' => 'Loan Against Property',
          'description' => 'Unlock funds for business, medical, or personal use. Quick approvals on secured loans with flexible options and minimal paperwork.',
          'features' => [
            'Loan up to 75% property value',
            'All purpose fund utilization',
            'Great interest savings',
            'Flexible repayment terms',
            'Effortless documentation'
          ]
        ]
      ];
      foreach($services as $index => $service): ?>
        <div class="service-card animate-on-scroll" data-delay="<?= $index * 200 ?>">
          <div class="service-icon"><i class="<?= $service['icon'] ?>"></i></div>
          <h3><?= $service['title'] ?></h3>
          <p><?= $service['description'] ?></p>
          <ul class="service-features">
            <?php foreach($service['features'] as $feature): ?>
              <li><i class="fas fa-check-circle"></i> <?= $feature ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="#contact" class="service-cta">Apply Now <i class="fas fa-arrow-right"></i></a>
        </div>
      <?php endforeach; ?>
    </div>
    <!-- STATS -->
    <!-- <div class="stats-banner animate-on-scroll" data-delay="600">
      <div class="stats-grid">
        <div class="stat-item">
          <span class="stat-number">15,000+</span>
          <div class="stat-label">Happy Families</div>
          <div class="stat-description">Dreams fulfilled, homes delivered</div>
        </div>
        <div class="stat-item">
          <span class="stat-number">₹2,500Cr+</span>
          <div class="stat-label">Loans Disbursed</div>
          <div class="stat-description">Total processed amount</div>
        </div>
        <div class="stat-item">
          <span class="stat-number">98.7%</span>
          <div class="stat-label">Approval Rate</div>
          <div class="stat-description">Industry’s leading acceptance</div>
        </div>
        <div class="stat-item">
          <span class="stat-number">24 Hrs</span>
          <div class="stat-label">Quickest Approval</div>
          <div class="stat-description">Get started within a day</div>
        </div>
      </div>
    </div> -->
  </div>

  <script>
    // Animate service cards on scroll (fade-in & slide-up)
    (() => {
      const cards = document.querySelectorAll('.service-card, .stats-banner');
      function showCards() {
        const trigger = window.innerHeight*0.92;
        cards.forEach(el => {
          const rect = el.getBoundingClientRect();
          if(rect.top < trigger) {
            el.style.opacity='1'; el.style.transform='translateY(0)';
          }
        });
      }
      cards.forEach(el => {
        el.style.opacity='0';
        el.style.transform='translateY(44px)';
        el.style.transition='opacity .8s, transform .9s cubic-bezier(.43,.12,.32,1)';
      });
      window.addEventListener('scroll', showCards, {passive:true});
      window.addEventListener('load', showCards);
    })();
    // Card 3D hover glow accent
    document.querySelectorAll('.service-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.boxShadow = '0 36px 82px 0 rgba(30,58,138,0.19)';
        this.querySelector('.service-icon').style.boxShadow = '0 8px 90px 0 #F59E0B55';
      });
      card.addEventListener('mouseleave', function() {
        this.style.boxShadow = '';
        this.querySelector('.service-icon').style.boxShadow = '0 8px 60px 0 rgba(30,58,138,0.13)';
      });
    });
  </script>
</section>
