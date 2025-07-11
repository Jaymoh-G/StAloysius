<div class="header-top">
    <div class="container">
        <div class="header-top-wrap">
            <div class="header-top-left">
                <div class="header-top-social">
                    <span>Follow Us: </span>
                    @if(setting('facebook'))
                    <a href="{{ setting('facebook') }}" target="_blank"
                        ><i class="fab fa-facebook-f"></i
                    ></a>
                    @endif @if(setting('instagram'))
                    <a href="{{ setting('instagram') }}" target="_blank"
                        ><i class="fab fa-instagram"></i
                    ></a>
                    @endif @if(setting('youtube'))
                    <a href="{{ setting('youtube') }}" target="_blank"
                        ><i class="fab fa-youtube"></i
                    ></a>
                    @endif @if(setting('linkedin'))
                    <a href="{{ setting('linkedin') }}" target="_blank"
                        ><i class="fab fa-linkedin"></i
                    ></a>
                    @endif
                    @if(setting('twitter'))
                    <a href="{{ setting('twitter') }}" target="_blank"
                        ><i class="fab fa-twitter"></i
                    ></a>
                    @endif
                    @if(setting('tiktok'))
                    <a href="{{ setting('tiktok') }}" target="_blank"
                        ><i class="fab fa-tiktok"></i
                    ></a>
                    @endif
                    @if(setting('whatsapp'))
                    <a href="{{ setting('whatsapp') }}" target="_blank"
                        ><i class="fab fa-whatsapp"></i
                    ></a>
                    @endif

                </div>
            </div>
            <div class="header-top-right">
                <div class="header-top-contact">
                    <ul>
                        @if(setting('address'))
                        <li>
                            <a href="{{ setting('google_map') }}" target="_blank"
                                ><i class="far fa-location-dot"></i>
                                {{ setting("address") }}</a
                            >
                        </li>
                        @endif @if(setting('email'))
                        <li>
                            <a href="mailto:{{ setting('email') }}"
                                ><i class="far fa-envelopes"></i>
                                {{ setting("email") }}</a
                            >
                        </li>
                        @endif @if(setting('phone'))
                        <li>
                            <a href="tel:{{ setting('phone') }}"
                                ><i class="far fa-phone-volume"></i
                                >{{ setting("phone") }}</a
                            >
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
