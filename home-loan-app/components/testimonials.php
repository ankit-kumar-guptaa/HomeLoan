<section id="testimonials" class="testimonials">
    <style>
        .testimonials{padding:6rem 0;background:#1E3A8A;color:#fff}
        .testimonials h2{text-align:center;font-size:2.3rem;margin-bottom:3rem}
        .t-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:2rem;max-width:1200px;margin:auto}
        .t-card{background:#ffffff14;border:1px solid #ffffff30;padding:2rem;border-radius:12px;backdrop-filter:blur(6px);transition:.3s}
        .t-card:hover{transform:translateY(-6px)}
        .stars{color:#F59E0B;font-size:.9rem;margin:.4rem 0}
        .client{font-weight:600;color:#F3F4F6}
    </style>

    <h2 class="animate-on-scroll">Customer Voices</h2>
    <div class="t-grid">
        <?php
        $reviews=[
            ['Rajesh Kumar','Mumbai','“Got approval in 3 days with the lowest rate.”'],
            ['Priya Sharma','Delhi','“Transparent process and great support!”'],
            ['Amit Patel','Pune','“Seamless transfer saved me ₹3 Lakh interest.”']
        ];
        foreach($reviews as $r){ ?>
        <div class="t-card animate-on-scroll">
            <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <p><?=$r[2]?></p>
            <div class="client">- <?=$r?>, <?=$r[1]?></div>
        </div>
        <?php } ?>
    </div>
</section>
