@extends('pages.front.layout.main')

@push('head')
<meta property="og:site_name" content="Website Resmi {{ getTitle() }}" />
<meta property="og:title" content="Kontak Resmi L|KITA Bengkalis" />
<meta property="og:description" content="Lihat daftar kontak kami" />
<meta property="og:image" content="{{ asset('themes/front/') }}/images/logo-hitam.png" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
@endpush

@section('content')
    <!-- Hero section Start -->
    <section class="hero-section bg-primary" id="home">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <hr style="border: 1px solid white;">
                    <div class="hero-wrapper pb-3">
                        <h6 class="text-white title">
                            <a href="{{ url('/') }}" class="text-white"><i class="mdi mdi-home"></i> Beranda</a>
                            <i class="mdi mdi-chevron-right"></i> FAQ
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>


<section class="modern-faq">
  <div class="container">
    <div class="faq-header text-center">
      <span class="faq-subtitle">Butuh Bantuan? </span>
      <h2 class="faq-title">Pertanyaan yang Sering Diajukan</h2>
      <div class="divider">
        <span class="divider-line"></span>
        <span class="divider-icon"><i class="fas fa-question"></i></span>
        <span class="divider-line"></span>
      </div>
    </div>

    <div class="faq-container">
      <div class="faq-image">
      <img src="{{ asset('assets/front/images/faq.jpg') }}" alt="Logo Putih" />
        {{-- <div class="image-badge">
          <i class="fas fa-headset"></i> 24/7 Support
        </div> --}}
      </div>

      <div class="faq-accordion" id="faqAccordion">
        @foreach ($dataview->faq as $item)
        <div class="accordion-item">
          <div class="accordion-header" onclick="toggleAccordion(this)">
            <i class="fas fa-question-circle"></i>
            <h3>{{ $item->question }}</h3>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="accordion-content">
            <p>{!! nl2br(e($item->answer)) !!}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<style>
/* Base Styles */
:root {
  --primary-blue: #2563eb;
  --dark-blue: #1e40af;
  --light-blue: #93c5fd;
  --bright-yellow: #fcd34d;
  --dark-yellow: #f59e0b;
  --light-gray: #f3f4f6;
  --medium-gray: #e5e7eb;
  --dark-gray: #4b5563;
  --white: #ffffff;
}

.modern-faq {
  padding: 5rem 0;
  background-color: var(--light-gray);
  position: relative;
  overflow: hidden;
}

/* Header Styles */
.faq-header {
  margin-bottom: 3rem;
  position: relative;
}

.faq-subtitle {
  display: inline-block;
  background-color: var(--bright-yellow);
  color: var(--dark-gray);
  padding: 0.5rem 1.5rem;
  border-radius: 50px;
  font-weight: 600;
  margin-bottom: 1rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.faq-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--dark-blue);
  margin-bottom: 1.5rem;
  position: relative;
}

.divider {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 1.5rem auto;
  max-width: 300px;
}

.divider-line {
  flex: 1;
  height: 2px;
  background: linear-gradient(90deg, var(--light-blue), var(--primary-blue));
}

.divider-icon {
  width: 40px;
  height: 40px;
  background-color: var(--bright-yellow);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 1rem;
  color: var(--dark-blue);
  font-size: 1.2rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* FAQ Container Layout */
.faq-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: center;
}

.faq-image {
  position: relative;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  transform: perspective(1000px) rotateY(-5deg);
  transition: all 0.3s ease;
}

.faq-image:hover {
  transform: perspective(1000px) rotateY(0deg);
}

.faq-image img {
  width: 100%;
  height: auto;
  display: block;
}

.image-badge {
  position: absolute;
  top: 20px;
  right: 20px;
  background-color: var(--primary-blue);
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 50px;
  font-weight: 600;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

/* Accordion Styles */
.faq-accordion {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.accordion-item {
  background-color: var(--white);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
  border-left: 4px solid var(--light-blue);
}

.accordion-item:hover {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  transform: translateY(-2px);
}

.accordion-item.active {
  border-left-color: var(--bright-yellow);
}

.accordion-header {
  padding: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
  background-color: var(--white);
  transition: all 0.3s ease;
  user-select: none;
}

.accordion-header h3 {
  margin: 0;
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--dark-blue);
  flex: 1;
  padding: 0 1rem;
}

.accordion-header i:first-child {
  color: var(--bright-yellow);
  font-size: 1.2rem;
}

.accordion-header i:last-child {
  color: var(--dark-blue);
  transition: transform 0.3s ease;
}

.accordion-item.active .accordion-header i:last-child {
  transform: rotate(180deg);
}

.accordion-content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out;
  padding: 0 1.5rem;
  background-color: rgba(147, 197, 253, 0.1);
}

.accordion-item.active .accordion-content {
  max-height: 300px;
  padding: 0 1.5rem 1.5rem;
}

.accordion-content p {
  margin: 0;
  color: var(--dark-gray);
  line-height: 1.6;
  padding-top: 1rem;
}

/* Responsive Design */
@media (max-width: 992px) {
  .faq-container {
    grid-template-columns: 1fr;
  }
  
  .faq-image {
    max-width: 500px;
    margin: 0 auto;
  }
  
  .faq-title {
    font-size: 2rem;
  }
}

/* Decorative Elements */
.modern-faq::before {
  content: '';
  position: absolute;
  top: -100px;
  right: -100px;
  width: 300px;
  height: 300px;
  background-color: rgba(251, 191, 36, 0.1);
  border-radius: 50%;
  z-index: 0;
}

.modern-faq::after {
  content: '';
  position: absolute;
  bottom: -50px;
  left: -50px;
  width: 200px;
  height: 200px;
  background-color: rgba(37, 99, 235, 0.1);
  border-radius: 50%;
  z-index: 0;
}
</style>

<script>
function toggleAccordion(header) {
  const item = header.parentElement;
  const content = header.nextElementSibling;
  
  // Close all other items
  document.querySelectorAll('.accordion-item').forEach(otherItem => {
    if (otherItem !== item) {
      otherItem.classList.remove('active');
      otherItem.querySelector('.accordion-content').style.maxHeight = '0';
      otherItem.querySelector('.accordion-content').style.padding = '0 1.5rem';
    }
  });
  
  // Toggle current item
  item.classList.toggle('active');
  
  if (item.classList.contains('active')) {
    content.style.maxHeight = content.scrollHeight + 'px';
    content.style.padding = '0 1.5rem 1.5rem';
  } else {
    content.style.maxHeight = '0';
    content.style.padding = '0 1.5rem';
  }
}

// Initialize first item as active by default
document.addEventListener('DOMContentLoaded', function() {
  const firstItem = document.querySelector('.accordion-item');
  if (firstItem) {
    firstItem.classList.add('active');
    const firstContent = firstItem.querySelector('.accordion-content');
    firstContent.style.maxHeight = firstContent.scrollHeight + 'px';
    firstContent.style.padding = '0 1.5rem 1.5rem';
  }
});
</script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 
            @endsection

@push('script')
@endpush
