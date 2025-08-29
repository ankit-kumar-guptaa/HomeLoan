// Global variables
let emiChart = null;
let currentSlide = 0;
let isCalculating = false;

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

// Initialize Application
function initializeApp() {
    initializeNavigation();
    initializeScrollAnimations();
    initializeEMICalculator();
    initializeFormHandlers();
    initializeSliders();
    initializeParallax();
    initializeCounters();
    initializeLazyLoading();
    
    // Add loading screen removal
    setTimeout(() => {
        const loader = document.querySelector('.page-loader');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => loader.remove(), 300);
        }
    }, 1000);
}

// Navigation Functions
function initializeNavigation() {
    const navbar = document.getElementById('navbar');
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        // Update active nav link
        updateActiveNavLink();
    });

    // Mobile menu toggle
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });
    }

    // Smooth scroll for nav links
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
            
            // Close mobile menu
            hamburger?.classList.remove('active');
            navMenu?.classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    });
}

// Update active navigation link
function updateActiveNavLink() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    
    let current = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.clientHeight;
        
        if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
}

// Scroll Animations
function initializeScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = entry.target.dataset.delay || 0;
                setTimeout(() => {
                    entry.target.classList.add('animated');
                }, delay);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
}

// EMI Calculator
function initializeEMICalculator() {
    const loanAmountSlider = document.getElementById('loanAmount');
    const interestRateSlider = document.getElementById('interestRate');
    const loanTenureSlider = document.getElementById('loanTenure');

    if (loanAmountSlider && interestRateSlider && loanTenureSlider) {
        // Add event listeners
        loanAmountSlider.addEventListener('input', debounce(calculateEMI, 100));
        interestRateSlider.addEventListener('input', debounce(calculateEMI, 100));
        loanTenureSlider.addEventListener('input', debounce(calculateEMI, 100));

        // Initial calculation
        calculateEMI();
        
        // Initialize chart after delay
        setTimeout(initializeChart, 500);
    }
}

// Calculate EMI
function calculateEMI() {
    if (isCalculating) return;
    isCalculating = true;

    const loanAmount = parseFloat(document.getElementById('loanAmount')?.value || 2500000);
    const annualRate = parseFloat(document.getElementById('interestRate')?.value || 8.5);
    const years = parseFloat(document.getElementById('loanTenure')?.value || 20);

    // EMI Calculation
    const monthlyRate = annualRate / 12 / 100;
    const numberOfPayments = years * 12;
    
    const emi = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / 
                (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
    
    const totalAmount = emi * numberOfPayments;
    const totalInterest = totalAmount - loanAmount;

    // Update UI
    updateCalculatorDisplay(loanAmount, emi, totalAmount, totalInterest, annualRate, years);
    updateChart(loanAmount, totalInterest);
    
    isCalculating = false;
}

// Update Calculator Display
function updateCalculatorDisplay(loanAmount, emi, totalAmount, totalInterest, rate, years) {
    // Update slider values
    updateElement('loanAmountValue', formatCurrency(loanAmount));
    updateElement('interestRateValue', rate.toFixed(1));
    updateElement('loanTenureValue', years.toString());

    // Update EMI display
    updateElement('emiResult', formatCurrency(emi));
    updateElement('tenureDisplay', years.toString());

    // Update breakdown
    updateElement('principalAmount', '₹' + formatCurrency(loanAmount));
    updateElement('totalInterest', '₹' + formatCurrency(totalInterest));
    updateElement('totalAmount', '₹' + formatCurrency(totalAmount));

    // Calculate and update insights
    updateInsights(loanAmount, emi, years, rate, totalInterest);
}

// Update Insights
function updateInsights(loanAmount, emi, years, rate, totalInterest) {
    // Savings with prepayment
    const annualPrepayment = 100000;
    const savings = calculatePrepaymentSavings(loanAmount, rate, years, annualPrepayment);
    updateElement('savingsAmount', formatCurrency(savings));

    // Tenure reduction with higher EMI
    const higherEMI = emi + 2000;
    const reducedTenure = calculateReducedTenure(loanAmount, rate, higherEMI);
    const tenureReduction = years - reducedTenure;
    updateElement('tenureReduction', tenureReduction.toFixed(1));

    // Interest vs Market
    const marketRate = rate + 1.2;
    const marketInterest = calculateTotalInterest(loanAmount, marketRate, years);
    const interestSavings = marketInterest - totalInterest;
    updateElement('interestSavings', formatCurrency(interestSavings));
}

// Chart Functions
function initializeChart() {
    const canvas = document.getElementById('emiChart');
    if (!canvas || typeof Chart === 'undefined') return;

    const ctx = canvas.getContext('2d');
    
    emiChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Principal Amount', 'Total Interest'],
            datasets: [{
                data: [2500000, 2566880],
                backgroundColor: ['#1e40af', '#f59e0b'],
                borderColor: ['#1e3a8a', '#d97706'],
                borderWidth: 3,
                hoverOffset: 15
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
                        padding: 20,
                        font: {
                            size: 14,
                            family: 'Poppins',
                            weight: '500'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#1e40af',
                    borderWidth: 1,
                    cornerRadius: 12,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = '₹' + formatCurrency(context.parsed);
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            elements: {
                arc: {
                    borderWidth: 3
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 1500,
                easing: 'easeInOutQuart'
            }
        }
    });
}

// Update Chart
function updateChart(principal, interest) {
    if (!emiChart) return;

    emiChart.data.datasets[0].data = [principal, interest];
    emiChart.update('active');
}

// Form Handlers
function initializeFormHandlers() {
    // Contact Form
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactForm);
    }

    // Newsletter Form
    const newsletterForm = document.getElementById('newsletterForm');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', handleNewsletterForm);
    }

    // Loan Application Form
    const loanForm = document.getElementById('loanApplicationForm');
    if (loanForm) {
        loanForm.addEventListener('submit', handleLoanApplication);
    }
}

// Handle Contact Form
async function handleContactForm(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    
    // Add loading state
    setLoadingState(submitButton, true);
    
    try {
        const response = await fetch('ajax/contact-form.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showNotification('Message sent successfully!', 'success');
            form.reset();
        } else {
            showNotification(result.message || 'Something went wrong!', 'error');
        }
    } catch (error) {
        showNotification('Network error. Please try again.', 'error');
    } finally {
        setLoadingState(submitButton, false);
    }
}

// Handle Newsletter Form
async function handleNewsletterForm(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    
    setLoadingState(submitButton, true);
    
    try {
        const response = await fetch('ajax/newsletter.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showNotification('Successfully subscribed to newsletter!', 'success');
            form.reset();
        } else {
            showNotification(result.message || 'Subscription failed!', 'error');
        }
    } catch (error) {
        showNotification('Network error. Please try again.', 'error');
    } finally {
        setLoadingState(submitButton, false);
    }
}

// Handle Loan Application
async function handleLoanApplication(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    
    // Add calculator values
    formData.append('calculatedEMI', document.getElementById('emiResult')?.textContent || '');
    formData.append('calculatedRate', document.getElementById('interestRateValue')?.textContent || '');
    formData.append('calculatedTenure', document.getElementById('loanTenureValue')?.textContent || '');
    
    const submitButton = form.querySelector('button[type="submit"]');
    setLoadingState(submitButton, true);
    
    try {
        const response = await fetch('ajax/loan-application.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showLoanApplicationSuccess(result);
            form.reset();
        } else {
            showNotification(result.message || 'Application failed!', 'error');
        }
    } catch (error) {
        showNotification('Network error. Please try again.', 'error');
    } finally {
        setLoadingState(submitButton, false);
    }
}

// Slider Animations
function initializeSliders() {
    const sliders = document.querySelectorAll('.slider');
    
    sliders.forEach(slider => {
        slider.addEventListener('input', function() {
            const value = (this.value - this.min) / (this.max - this.min) * 100;
            this.style.background = `linear-gradient(to right, #f59e0b 0%, #f59e0b ${value}%, rgba(255,255,255,0.2) ${value}%, rgba(255,255,255,0.2) 100%)`;
        });
        
        // Initialize slider appearance
        slider.dispatchEvent(new Event('input'));
    });
}

// Parallax Effects
function initializeParallax() {
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.parallax-element');
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    });
}

// Counter Animations
function initializeCounters() {
    const counters = document.querySelectorAll('.counter');
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => {
        counterObserver.observe(counter);
    });
}

// Animate Counter
function animateCounter(element) {
    const target = parseInt(element.dataset.count);
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target.toLocaleString();
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current).toLocaleString();
        }
    }, 16);
}

// Lazy Loading
function initializeLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Loan Application Functions
function applyForLoan() {
    const loanData = {
        amount: document.getElementById('loanAmountValue')?.textContent || '',
        emi: document.getElementById('emiResult')?.textContent || '',
        rate: document.getElementById('interestRateValue')?.textContent || '',
        tenure: document.getElementById('loanTenureValue')?.textContent || ''
    };
    
    showLoanModal(loanData);
}

function showLoanModal(loanData) {
    const modal = createModal(`
        <div class="loan-modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-check-circle"></i> Excellent Choice!</h3>
                <button class="modal-close" onclick="closeLoanModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="loan-summary">
                    <h4>Your Loan Summary</h4>
                    <div class="summary-grid">
                        <div class="summary-item">
                            <span>Loan Amount:</span>
                            <span class="value">₹${loanData.amount}</span>
                        </div>
                        <div class="summary-item">
                            <span>Monthly EMI:</span>
                            <span class="value">₹${loanData.emi}</span>
                        </div>
                        <div class="summary-item">
                            <span>Interest Rate:</span>
                            <span class="value">${loanData.rate}% p.a.</span>
                        </div>
                        <div class="summary-item">
                            <span>Tenure:</span>
                            <span class="value">${loanData.tenure} years</span>
                        </div>
                    </div>
                </div>
                
                <div class="modal-benefits">
                    <h4>Why Choose Elite Corporate Solutions?</h4>
                    <div class="benefits-grid">
                        <div class="benefit-item">
                            <i class="fas fa-clock"></i>
                            <span>Quick approval in 24-48 hours</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>100% secure & transparent process</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-user-tie"></i>
                            <span>Dedicated relationship manager</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-award"></i>
                            <span>15+ years of experience</span>
                        </div>
                    </div>
                </div>
                
                <div class="modal-actions">
                    <button class="btn btn-primary" onclick="proceedToApplication()">
                        <i class="fas fa-arrow-right"></i> Start Application
                    </button>
                    <button class="btn btn-outline" onclick="downloadCalculation()">
                        <i class="fas fa-download"></i> Download Report
                    </button>
                </div>
            </div>
        </div>
    `);
    
    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';
    
    // Animation
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

function closeLoanModal() {
    const modal = document.querySelector('.loan-modal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.remove();
            document.body.style.overflow = '';
        }, 300);
    }
}

function proceedToApplication() {
    closeLoanModal();
    
    // Scroll to contact form
    const contactSection = document.getElementById('contact');
    if (contactSection) {
        contactSection.scrollIntoView({ behavior: 'smooth' });
        
        // Pre-fill form
        setTimeout(() => {
            prefillLoanForm();
        }, 1000);
    }
}

function prefillLoanForm() {
    const loanAmountField = document.querySelector('input[name="loanAmount"]');
    const loanTypeField = document.querySelector('select[name="loanType"]');
    
    if (loanAmountField) {
        loanAmountField.value = document.getElementById('loanAmount')?.value || '';
    }
    
    if (loanTypeField && !loanTypeField.value) {
        loanTypeField.value = 'home-purchase';
    }
}

function downloadCalculation() {
    const loanData = {
        amount: document.getElementById('loanAmountValue')?.textContent || '',
        emi: document.getElementById('emiResult')?.textContent || '',
        rate: document.getElementById('interestRateValue')?.textContent || '',
        tenure: document.getElementById('loanTenureValue')?.textContent || '',
        principal: document.getElementById('principalAmount')?.textContent || '',
        interest: document.getElementById('totalInterest')?.textContent || '',
        total: document.getElementById('totalAmount')?.textContent || ''
    };
    
    generatePDFReport(loanData);
}

// Notification System
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${getNotificationIcon(type)}"></i>
            <span>${message}</span>
            <button class="notification-close" onclick="closeNotification(this)">&times;</button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Show animation
    setTimeout(() => notification.classList.add('show'), 10);
    
    // Auto remove
    setTimeout(() => {
        if (notification.parentNode) {
            closeNotification(notification.querySelector('.notification-close'));
        }
    }, 5000);
}

function closeNotification(button) {
    const notification = button.closest('.notification');
    notification.classList.remove('show');
    setTimeout(() => notification.remove(), 300);
}

function getNotificationIcon(type) {
    const icons = {
        success: 'check-circle',
        error: 'exclamation-circle',
        warning: 'exclamation-triangle',
        info: 'info-circle'
    };
    return icons[type] || icons.info;
}

// Utility Functions
function updateElement(id, value) {
    const element = document.getElementById(id);
    if (element) {
        element.textContent = value;
    }
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('en-IN', {
        maximumFractionDigits: 0
    }).format(Math.round(amount));
}

function setLoadingState(button, loading) {
    if (!button) return;
    
    if (loading) {
        button.disabled = true;
        button.classList.add('loading');
        const originalText = button.innerHTML;
        button.dataset.originalText = originalText;
        button.innerHTML = `<span class="spinner"></span> Processing...`;
    } else {
        button.disabled = false;
        button.classList.remove('loading');
        button.innerHTML = button.dataset.originalText || button.innerHTML;
    }
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function createModal(content) {
    const modal = document.createElement('div');
    modal.className = 'loan-modal';
    modal.innerHTML = content;
    
    // Close on background click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeLoanModal();
        }
    });
    
    return modal;
}

// Calculation Helper Functions
function calculatePrepaymentSavings(principal, rate, years, prepayment) {
    const monthlyRate = rate / 12 / 100;
    const months = years * 12;
    
    // Regular loan calculation
    const regularEMI = (principal * monthlyRate * Math.pow(1 + monthlyRate, months)) / 
                      (Math.pow(1 + monthlyRate, months) - 1);
    const regularTotal = regularEMI * months;
    
    // With prepayment (simplified calculation)
    const effectivePrincipal = principal - (prepayment * 0.3); // Approximate effect
    const prepaymentEMI = (effectivePrincipal * monthlyRate * Math.pow(1 + monthlyRate, months)) / 
                         (Math.pow(1 + monthlyRate, months) - 1);
    const prepaymentTotal = (prepaymentEMI * months) + prepayment;
    
    return Math.max(0, regularTotal - prepaymentTotal);
}

function calculateReducedTenure(principal, rate, emi) {
    const monthlyRate = rate / 12 / 100;
    
    if (emi <= principal * monthlyRate) {
        return 30; // Max tenure if EMI is too low
    }
    
    const months = Math.log(1 + (principal * monthlyRate) / emi) / Math.log(1 + monthlyRate);
    return Math.max(1, months / 12);
}

function calculateTotalInterest(principal, rate, years) {
    const monthlyRate = rate / 12 / 100;
    const months = years * 12;
    
    const emi = (principal * monthlyRate * Math.pow(1 + monthlyRate, months)) / 
                (Math.pow(1 + monthlyRate, months) - 1);
    
    return (emi * months) - principal;
}

function generatePDFReport(loanData) {
    // Create a simple report (you can enhance this with jsPDF library)
    const reportContent = `
LOAN CALCULATION REPORT
Elite Corporate Solutions
Generated on: ${new Date().toLocaleDateString()}

LOAN DETAILS:
- Loan Amount: ₹${loanData.amount}
- Interest Rate: ${loanData.rate}% per annum
- Loan Tenure: ${loanData.tenure} years
- Monthly EMI: ₹${loanData.emi}

PAYMENT BREAKDOWN:
- Principal Amount: ${loanData.principal}
- Total Interest: ${loanData.interest}
- Total Amount Payable: ${loanData.total}

CONTACT INFORMATION:
Elite Corporate Solutions
Phone: +91 98765 43210
Email: info@elitecorporate.com
Website: www.elitecorporate.com

Serving customers since 2010 with excellence!
    `;
    
    // Create and download file
    const blob = new Blob([reportContent], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `loan-calculation-report-${Date.now()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showNotification('Report downloaded successfully!', 'success');
}

function showLoanApplicationSuccess(result) {
    const modal = createModal(`
        <div class="success-modal-content">
            <div class="success-header">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Application Submitted Successfully!</h3>
                <p>Application ID: #${result.applicationId || 'ECS' + Date.now()}</p>
            </div>
            <div class="success-body">
                <div class="success-message">
                    <p>Thank you for choosing Elite Corporate Solutions! Your home loan application has been received and is being processed.</p>
                    
                    <div class="next-steps">
                        <h4>What happens next?</h4>
                        <div class="steps">
                            <div class="step">
                                <span class="step-number">1</span>
                                <span class="step-text">Document verification within 24 hours</span>
                            </div>
                            <div class="step">
                                <span class="step-number">2</span>
                                <span class="step-text">Credit assessment and approval</span>
                            </div>
                            <div class="step">
                                <span class="step-number">3</span>
                                <span class="step-text">Loan disbursement</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-info">
                        <p><strong>Our loan expert will contact you within 2 hours!</strong></p>
                        <p>For any queries, call us at <strong>+91 98765 43210</strong></p>
                    </div>
                </div>
                
                <div class="success-actions">
                    <button class="btn btn-primary" onclick="closeLoanModal()">
                        <i class="fas fa-check"></i> Got It
                    </button>
                </div>
            </div>
        </div>
    `);
    
    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';
    
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

// Additional CSS for modals and notifications (add to your CSS file)
const additionalStyles = `
/* Modal Styles */
.loan-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.loan-modal.show {
    opacity: 1;
    visibility: visible;
}

.loan-modal-content,
.success-modal-content {
    background: white;
    max-width: 600px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    border-radius: 1rem;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    transform: translateY(30px) scale(0.95);
    transition: all 0.3s ease;
}

.loan-modal.show .loan-modal-content,
.loan-modal.show .success-modal-content {
    transform: translateY(0) scale(1);
}

.modal-header {
    background: var(--gradient-primary);
    color: white;
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modal-close {
    background: none;
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: var(--transition);
}

.modal-close:hover {
    background: rgba(255, 255, 255, 0.2);
}

.modal-body {
    padding: 2rem;
}

.summary-grid {
    display: grid;
    gap: 1rem;
    margin: 1rem 0 2rem;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 1rem;
    background: var(--light);
    border-radius: 0.5rem;
}

.summary-item .value {
    font-weight: 700;
    color: var(--primary);
}

.benefits-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin: 1rem 0 2rem;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: var(--light);
    border-radius: 0.5rem;
    font-size: 0.9rem;
}

.benefit-item i {
    color: var(--success);
}

.modal-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

/* Success Modal */
.success-header {
    background: var(--gradient-success);
    color: white;
    padding: 3rem 2rem;
    text-align: center;
}

.success-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.success-body {
    padding: 2rem;
}

.next-steps {
    margin: 2rem 0;
    padding: 1.5rem;
    background: var(--light);
    border-radius: 0.5rem;
}

.steps {
    display: grid;
    gap: 1rem;
    margin-top: 1rem;
}

.step {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.step-number {
    width: 30px;
    height: 30px;
    background: var(--primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
}

.contact-info {
    margin-top: 2rem;
    padding: 1.5rem;
    background: #fef3cd;
    border-radius: 0.5rem;
    border-left: 4px solid var(--secondary);
}

.success-actions {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

/* Notification Styles */
.notification {
    position: fixed;
    top: 2rem;
    right: 2rem;
    background: white;
    border-radius: 0.75rem;
    box-shadow: var(--shadow-xl);
    border-left: 4px solid var(--primary);
    z-index: 10001;
    transform: translateX(100%);
    transition: all 0.3s ease;
    max-width: 400px;
}

.notification.show {
    transform: translateX(0);
}

.notification-success { border-left-color: var(--success); }
.notification-error { border-left-color: var(--accent); }
.notification-warning { border-left-color: var(--secondary); }

.notification-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
}

.notification-content i {
    font-size: 1.25rem;
}

.notification-success i { color: var(--success); }
.notification-error i { color: var(--accent); }
.notification-warning i { color: var(--secondary); }
.notification i { color: var(--primary); }

.notification-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    cursor: pointer;
    color: var(--text-light);
    padding: 0.25rem;
    margin-left: auto;
}

.notification-close:hover {
    color: var(--text-primary);
}

@media (max-width: 768px) {
    .notification {
        top: 1rem;
        right: 1rem;
        left: 1rem;
        max-width: none;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
    
    .modal-actions {
        grid-template-columns: 1fr;
    }
}
`;

// Add additional styles to head
const styleSheet = document.createElement('style');
styleSheet.textContent = additionalStyles;
document.head.appendChild(styleSheet);

// Export functions for global access
window.applyForLoan = applyForLoan;
window.closeLoanModal = closeLoanModal;
window.proceedToApplication = proceedToApplication;
window.downloadCalculation = downloadCalculation;
window.closeNotification = closeNotification;


// Enhanced JavaScript with proper parallax and animations
document.addEventListener('DOMContentLoaded', function() {
    initNavigation();
    initParallax();
    initAnimations();
    initForms();
});

// Navigation with scroll effects
function initNavigation() {
    const navbar = document.getElementById('navbar');
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');

    // Navbar background change on scroll
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(255,255,255,0.98)';
            navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
        } else {
            navbar.style.background = 'rgba(255,255,255,0.95)';
            navbar.style.boxShadow = 'none';
        }
    });

    // Mobile menu toggle
    if (hamburger) {
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            // Transform hamburger to X
            hamburger.classList.toggle('active');
        });
    }

    // Smooth scroll for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
            
            // Close mobile menu
            navMenu.classList.remove('active');
            hamburger.classList.remove('active');
        });
    });
}

// Enhanced Parallax Effects
function initParallax() {
    let ticking = false;
    
    function updateParallax() {
        const scrolled = window.pageYOffset;
        
        // Hero background parallax
        const heroBg = document.getElementById('heroBg');
        if (heroBg) {
            const parallaxSpeed = 0.5;
            heroBg.style.transform = `translateY(${scrolled * parallaxSpeed}px)`;
        }
        
        // Other parallax elements
        document.querySelectorAll('[data-parallax]').forEach(element => {
            const speed = parseFloat(element.dataset.parallax) || 0.5;
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
        
        ticking = false;
    }
    
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', requestTick);
}

// Scroll animations with Intersection Observer
function initAnimations() {
    // Create intersection observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const delay = parseInt(element.dataset.delay) || 0;
                
                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                    element.classList.add('animated');
                }, delay);
                
                observer.unobserve(element);
            }
        });
    }, observerOptions);

    // Observe all elements with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(50px)';
        el.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(el);
    });

    // Add number counting animation
    initCounters();
}

// Counter animation for statistics
function initCounters() {
    const counters = document.querySelectorAll('.stat-number');
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.7 });
    
    counters.forEach(counter => {
        counterObserver.observe(counter);
    });
}

function animateCounter(element) {
    const text = element.textContent;
    const number = parseInt(text.replace(/[^\d]/g, ''));
    const suffix = text.replace(/[\d,]/g, '');
    const duration = 2000;
    const increment = number / (duration / 16);
    let current = 0;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= number) {
            element.textContent = number.toLocaleString('en-IN') + suffix;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current).toLocaleString('en-IN') + suffix;
        }
    }, 16);
}

// Enhanced form handling
function initForms() {
    // Quick loan form (hero section)
    const quickForm = document.getElementById('quickLoanForm');
    if (quickForm) {
        quickForm.addEventListener('submit', handleQuickLoanForm);
    }

    // Eligibility form
    const eligibilityForm = document.getElementById('eligibilityForm');
    if (eligibilityForm) {
        eligibilityForm.addEventListener('submit', handleEligibilityForm);
    }

    // Contact form
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactForm);
    }
}

async function handleQuickLoanForm(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('.submit-btn');
    const originalHTML = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    submitBtn.disabled = true;
    
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 2000));
    
    // Show success message
    showNotification('🎉 Thank you! Our loan expert will call you within 30 minutes.', 'success');
    
    // Reset form
    form.reset();
    submitBtn.innerHTML = originalHTML;
    submitBtn.disabled = false;
}

async function handleEligibilityForm(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Show loading
    setButtonLoading(submitBtn, true);
    
    // Simple eligibility calculation
    const income = parseFloat(formData.get('monthlyIncome'));
    const existingEMI = parseFloat(formData.get('monthlyEMI')) || 0;
    const creditScore = parseFloat(formData.get('creditScore')) || 750;
    
    // Calculate eligibility (simplified logic)
    const netIncome = income - existingEMI;
    let multiplier = 60; // Base multiplier
    
    if (creditScore > 750) multiplier = 70;
    else if (creditScore < 650) multiplier = 40;
    
    const eligibleAmount = Math.round(netIncome * multiplier);
    
    await new Promise(resolve => setTimeout(resolve, 2500));
    
    // Show results
    document.getElementById('eligibleAmount').textContent = formatNumber(eligibleAmount);
    document.getElementById('eligibilityResult').style.display = 'block';
    
    setButtonLoading(submitBtn, false);
    
    // Show additional info
    showNotification(`🏠 Great! You're eligible for up to ₹${formatNumber(eligibleAmount)}. Apply now for quick approval!`, 'success');
}

async function handleContactForm(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    
    setButtonLoading(submitBtn, true);
    
    await new Promise(resolve => setTimeout(resolve, 1500));
    
    showNotification('✅ Message sent successfully! We will get back to you within 2 hours.', 'success');
    form.reset();
    setButtonLoading(submitBtn, false);
}

// Utility functions
function setButtonLoading(button, loading) {
    if (loading) {
        button.dataset.originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        button.disabled = true;
    } else {
        button.innerHTML = button.dataset.originalText || 'Submit';
        button.disabled = false;
    }
}

function formatNumber(num) {
    return new Intl.NumberFormat('en-IN', {maximumFractionDigits: 0}).format(Math.round(num));
}

// Enhanced notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 2rem;
        right: 2rem;
        background: ${type === 'success' ? '#10B981' : type === 'error' ? '#EF4444' : '#3B82F6'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        z-index: 10000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        max-width: 400px;
        font-weight: 500;
    `;
    
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
    }, 5000);
    
    // Close button
    notification.querySelector('.notification-close').addEventListener('click', () => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
    });
}

// Apply for loan function (called from calculator)
function applyForLoan() {
    const amount = document.getElementById('loanAmountValue')?.textContent || '';
    const emi = document.getElementById('emiResult')?.textContent || '';
    
    if (confirm(`🏠 Ready to apply for loan amount ₹${amount} with monthly EMI ₹${emi}?\n\nYou'll be redirected to our application form.`)) {
        document.getElementById('contact').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
        
        // Pre-fill contact form if possible
        setTimeout(() => {
            const loanAmountField = document.querySelector('input[name="loanAmount"]');
            if (loanAmountField && amount) {
                loanAmountField.value = amount.replace(/[^\d]/g, '');
            }
        }, 1000);
    }
}

// Add smooth hover effects to interactive elements
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to buttons
    document.querySelectorAll('.btn, .cta-button, .submit-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Add interactive effects to cards
    document.querySelectorAll('.service-card, .feature-card, .testimonial-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});

// Performance optimization
function throttle(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle scroll events for better performance
window.addEventListener('scroll', throttle(() => {
    // Any scroll-based animations can be added here
}, 16)); // ~60fps
