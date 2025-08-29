<section id="about" class="about parallax-section">
    <style>
        .about{padding:8rem 0;background:#f8fafc;position:relative;overflow:hidden}
        .about-container{max-width:1400px;margin:0 auto;padding:0 2rem}
        .about-content{display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;margin-bottom:6rem}
        .about-text h2{font-size:clamp(2.5rem,4vw,3.5rem);color:#111827;margin-bottom:1.5rem;font-weight:700}
        .about-subtitle{font-size:1.3rem;color:#F59E0B;font-weight:600;margin-bottom:1rem}
        .about-description{font-size:1.2rem;color:#6b7280;margin-bottom:2rem;line-height:1.8}
        .about-highlights{display:grid;gap:1.5rem;margin-bottom:3rem}
        .highlight{display:flex;align-items:flex-start;gap:1rem;padding:1.5rem;background:#fff;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.05)}
        .highlight-icon{width:60px;height:60px;background:linear-gradient(135deg,#1E3A8A,#3730A3);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem;flex-shrink:0}
        .highlight-content h4{color:#111827;margin-bottom:0.5rem;font-size:1.2rem}
        .highlight-content p{color:#6b7280;margin:0;line-height:1.6}
        .about-cta{display:flex;gap:1rem;flex-wrap:wrap}
        .image-section{position:relative}
        .image-grid{display:grid;grid-template-columns:1fr 1fr;gap:2rem;height:500px}
        .image-item{border-radius:20px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.1)}
        .image-item img{width:100%;height:100%;object-fit:cover;transition:0.4s}
        .image-item:hover img{transform:scale(1.05)}
        .image-item.tall{grid-row:1/3}
        .experience-badge{position:absolute;top:2rem;right:2rem;background:linear-gradient(135deg,#F59E0B,#D97706);color:#fff;padding:2rem;border-radius:20px;text-align:center;box-shadow:0 10px 30px rgba(245,158,11,0.3)}
        .experience-number{font-size:3rem;font-weight:700;line-height:1}
        .experience-text{font-size:1rem;margin-top:0.5rem;opacity:0.9}
        .journey-section{margin-top:6rem}
        .journey-header{text-align:center;margin-bottom:4rem}
        .journey-timeline{display:grid;grid-template-columns:repeat(4,1fr);gap:2rem}
        .timeline-item{text-align:center;position:relative}
        .timeline-item::after{content:'';position:absolute;top:50px;right:-50%;width:100%;height:2px;background:linear-gradient(90deg,#1E3A8A,#F59E0B);display:block}
        .timeline-item:last-child::after{display:none}
        .timeline-icon{width:100px;height:100px;background:linear-gradient(135deg,#1E3A8A,#3730A3);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;color:#fff;font-size:2rem}
        .timeline-year{font-size:1.5rem;font-weight:700;color:#F59E0B;margin-bottom:0.5rem}
        .timeline-title{font-size:1.2rem;color:#111827;margin-bottom:0.5rem;font-weight:600}
        .timeline-desc{color:#6b7280;font-size:1rem}
        @media(max-width:992px){.about-content{grid-template-columns:1fr}.journey-timeline{grid-template-columns:1fr}.timeline-item::after{display:none}}
    </style>

    <div class="about-container">
        <div class="about-content">
            <div class="about-text animate-on-scroll">
                <div class="about-subtitle">About Elite Corporate Solutions</div>
                <h2>15 Years of Trust, Excellence & Innovation</h2>
                <p class="about-description">
                    Since 2010, Elite Corporate Solutions has been the cornerstone of homeownership dreams for thousands of Indian families. What started as a vision to simplify home financing has evolved into India's most trusted home loan consultancy.
                </p>

                <div class="about-highlights">
                    <div class="highlight">
                        <div class="highlight-icon"><i class="fas fa-award"></i></div>
                        <div class="highlight-content">
                            <h4>Industry Leadership</h4>
                            <p>Recognized as one of India's top home loan consultancies with numerous industry awards and certifications.</p>
                        </div>
                    </div>
                    <div class="highlight">
                        <div class="highlight-icon"><i class="fas fa-users"></i></div>
                        <div class="highlight-content">
                            <h4>Expert Team</h4>
                            <p>Over 150 certified loan specialists with deep banking relationships and unmatched expertise.</p>
                        </div>
                    </div>
                    <div class="highlight">
                        <div class="highlight-icon"><i class="fas fa-handshake"></i></div>
                        <div class="highlight-content">
                            <h4>End-to-End Service</h4>
                            <p>From initial consultation to key handover, we handle every aspect of your home loan journey.</p>
                        </div>
                    </div>
                </div>

                <div class="about-cta">
                    <a href="#contact" class="btn btn-primary"><i class="fas fa-phone"></i> Talk to Expert</a>
                    <a href="#services" class="btn btn-outline">Our Services</a>
                </div>
            </div>

            <div class="image-section animate-on-scroll" data-delay="200">
                <div class="image-grid">
                    <div class="image-item tall">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?auto=format&fit=crop&w=800&q=80" alt="Happy Family">
                    </div>
                    <div class="image-item">
                        <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=800&q=80" alt="Dream Home">
                    </div>
                    <div class="image-item">
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80" alt="Modern House">
                    </div>
                </div>
                <div class="experience-badge">
                    <div class="experience-number">15+</div>
                    <div class="experience-text">Years of Excellence</div>
                </div>
            </div>
        </div>

        <div class="journey-section animate-on-scroll" data-delay="400">
            <div class="journey-header">
                <h2 style="font-size:2.5rem;color:#111827;margin-bottom:1rem">Our Journey of Excellence</h2>
                <p style="font-size:1.2rem;color:#6b7280">Milestones that define our commitment to your dreams</p>
            </div>

            <div class="journey-timeline">
                <div class="timeline-item">
                    <div class="timeline-icon"><i class="fas fa-rocket"></i></div>
                    <div class="timeline-year">2010</div>
                    <div class="timeline-title">Foundation</div>
                    <div class="timeline-desc">Started with a vision to simplify home loans for Indian families</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon"><i class="fas fa-trophy"></i></div>
                    <div class="timeline-year">2015</div>
                    <div class="timeline-title">Recognition</div>
                    <div class="timeline-desc">Received "Best Home Loan Consultant" award, serving 5,000+ families</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon"><i class="fas fa-expand-arrows-alt"></i></div>
                    <div class="timeline-year">2020</div>
                    <div class="timeline-title">Expansion</div>
                    <div class="timeline-desc">Expanded to 25+ cities, crossed ₹1000 Cr in loan disbursements</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon"><i class="fas fa-crown"></i></div>
                    <div class="timeline-year">2025</div>
                    <div class="timeline-title">Excellence</div>
                    <div class="timeline-desc">15,000+ happy families, India's most trusted home loan partner</div>
                </div>
            </div>
        </div>
    </div>
</section>
