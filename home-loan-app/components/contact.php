<section id="contact" class="contact">
    <style>
        .contact{padding:6rem 0}
        .contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:3rem;max-width:1200px;margin:auto}
        .info{display:grid;gap:1.5rem}
        .card{border:1px solid #e5e7eb;border-radius:10px;padding:1.5rem;text-align:center}
        .card i{font-size:1.4rem;color:#1E3A8A;margin-bottom:.6rem}
        .card h3{color:#111827;margin-bottom:.3rem}
        .card p{color:#6B7280;font-size:.92rem;margin:0}
        .form{border:1px solid #e5e7eb;border-radius:10px;padding:2rem}
        .form .field{margin-bottom:1rem}
        .form input,.form select,.form textarea{width:100%;padding:.8rem 1rem;border:1px solid #d1d5db;border-radius:8px;font-size:.95rem}
        .form button{margin-top:.5rem}
        @media(max-width:992px){.contact-grid{grid-template-columns:1fr}}
    </style>

    <div class="contact-grid animate-on-scroll">
        <div class="info">
            <div class="card"><i class="fas fa-map-marker-alt"></i><h3>Visit Us</h3><p>123 Business District<br>Noida, Uttar Pradesh 201301</p></div>
            <div class="card"><i class="fas fa-phone"></i><h3>Call Us</h3><p>+91 98765 43210</p></div>
            <div class="card"><i class="fas fa-envelope"></i><h3>Email</h3><p>info@elitecorporate.com</p></div>
        </div>

        <form id="contactForm" class="form">
            <div class="field"><input name="firstName" placeholder="First Name" required></div>
            <div class="field"><input name="lastName" placeholder="Last Name" required></div>
            <div class="field"><input type="email" name="email" placeholder="Email Address" required></div>
            <div class="field"><input name="phone" placeholder="Phone Number" required></div>
            <div class="field"><textarea name="message" rows="4" placeholder="Your Message" required></textarea></div>
            <button class="btn btn-primary" type="submit">Send Message</button>
        </form>
    </div>
</section>
