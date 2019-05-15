@if($rate >= 4.75)
    <div class="star-rating">
        <div class="star-rating-front" style="width: 100%">★★★★★</div>
        <div class="star-rating-back">★★★★★</div>
    </div>
@elseif($rate >= 4.5)
    <div class="star-rating">
        <div class="star-rating-front" style="width: 80%">★★★★★</div>
        <div class="star-rating-back">★★★★★</div>
    </div>
@elseif($rate >= 4)
    <div class="star-rating">
        <div class="star-rating-front" style="width: 70%">★★★★★</div>
        <div class="star-rating-back">★★★★★</div>
    </div>
@elseif($rate >= 3.5)
    <div class="star-rating">
        <div class="star-rating-front" style="width: 63%">★★★★★</div>
        <div class="star-rating-back">★★★★★</div>
    </div>
@elseif($rate >= 3)
    <div class="star-rating">
        <div class="star-rating-front" style="width: 55%">★★★★★</div>
        <div class="star-rating-back">★★★★★</div>
    </div>
@elseif($rate >= 2.5)
    <div class="star-rating">
        <div class="star-rating-front" style="width: 45%">★★★★★</div>
        <div class="star-rating-back">★★★★★</div>
    </div>
@elseif($rate >= 2)
    <div class="star-rating">
        <div class="star-rating-front" style="width: 35%">★★★★★</div>
        <div class="star-rating-back">★★★★★</div>
    </div>
@elseif($rate >= 1.5)
    <div class="star-rating">
        <div class="star-rating-front" style="width: 27%">★★★★★</div>
        <div class="star-rating-back">★★★★★</div>
    </div>
@elseif($rate < 1.5)
    <div class="star-rating">
        <div class="star-rating-front" style="width: 20%">★★★★★</div>
        <div class="star-rating-back">★★★★★</div>
    </div>
@endif