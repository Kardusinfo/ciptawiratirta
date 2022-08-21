<!-- Other Options -->
<div class="other-options">
    <div class="social-share">
        <h5>{{ __("Share this job") }}</h5>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $row->getDetailUrl() }}&amp;title={{ $translation->title }}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i> {{ __("Facebook") }}</a>
        <a href="whatsapp://send?text=The text to share!{{ $row->getDetailUrl() }}&amp;title={{ $translation->title }}" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i> {{ __("Whatsapp") }}</a>
        <a href="https://www.instagram.com/?url={{ $row->getDetailUrl() }}&description={{ $translation->title }}" target="_blank" class="instagram"><i class="fab fa-instagram"></i> {{ __("Instagram") }}</a>
    </div>
</div>
