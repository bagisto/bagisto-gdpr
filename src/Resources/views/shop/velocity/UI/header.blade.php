@push('scripts')
    <script type="text/x-template" id="content-header-template">
        <header class="row velocity-divide-page vc-header header-shadow active">
            <div class="vc-small-screen container">
                <div class="row">
                    <div class="col-6">
                        <div v-if="hamburger" class="nav-container scrollable">
                            <div class="wrapper" v-if="this.rootCategories">
                                <div class="greeting drawer-section fw6">
                                    <i class="material-icons">perm_identity</i>
                                    <span>
                                        @guest('customer')
                                            <a class="unset" href="{{ route('customer.session.index') }}">
                                            {{ __('velocity::app.responsive.header.greeting', ['customer' => 'Guest']) }}
                                            </a>
                                        @endguest

                                        @auth('customer')
                                            <a class="unset" href="{{ route('customer.profile.index') }}">
                                                {{ __('velocity::app.responsive.header.greeting', ['customer' => auth()->guard('customer')->user()->first_name]) }}
                                            </a>
                                        @endauth

                                        <i
                                            @click="closeDrawer()"
                                            class="material-icons float-right text-dark">
                                            cancel
                                        </i>
                                    </span>
                                </div>

                                @php
                                    $currency = $locale = null;

                                    $currentLocale = app()->getLocale();
                                    $currentCurrency = core()->getCurrentCurrencyCode();

                                    $allLocales = core()->getCurrentChannel()->locales;
                                    $allCurrency = core()->getCurrentChannel()->currencies;
                                @endphp

                                @foreach ($allLocales as $appLocale)
                                    @if ($appLocale->code == $currentLocale)
                                        @php
                                            $locale = $appLocale;
                                        @endphp
                                    @endif
                                @endforeach

                                @foreach ($allCurrency as $appCurrency)
                                    @if ($appCurrency->code == $currentCurrency)
                                        @php
                                            $currency = $appCurrency;
                                        @endphp
                                    @endif
                                @endforeach

                                <ul type="none" class="velocity-content" v-if="headerContent.length > 0">
                                    <li :key="index" v-for="(content, index) in headerContent">
                                        <a
                                            class="unset"
                                            v-text="content.title"
                                            :href="`${$root.baseUrl}/${content.page_link}`">
                                        </a>
                                    </li>
                                </ul>

                                <ul type="none" class="category-wrapper" v-if="rootCategoriesCollection.length > 0">
                                    <li v-for="(category, index) in rootCategoriesCollection">
                                        <a class="unset" :href="`${$root.baseUrl}/${category.slug}`">
                                            <div class="category-logo">
                                                <img
                                                    class="category-icon"
                                                    v-if="category.category_icon_path"
                                                    :src="`${$root.baseUrl}/storage/${category.category_icon_path}`" alt="" width="20" height="20" />
                                            </div>
                                            <span v-text="category.name"></span>
                                        </a>

                                        <i class="rango-arrow-right" @click="toggleSubcategories(index, $event)"></i>
                                    </li>
                                </ul>

                                @auth('customer')
                                    <ul type="none" class="vc-customer-options">
                                        <li>
                                            <a href="{{ route('customer.profile.index') }}" class="unset">
                                                <i class="icon profile text-down-3"></i>
                                                <span>{{ __('shop::app.header.profile') }}</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('customer.address.index') }}" class="unset">
                                                <i class="icon address text-down-3"></i>
                                                <span>{{ __('velocity::app.shop.general.addresses') }}</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('customer.reviews.index') }}" class="unset">
                                                <i class="icon reviews text-down-3"></i>
                                                <span>{{ __('velocity::app.shop.general.reviews') }}</span>
                                            </a>
                                        </li>

                                        @if (core()->getConfigData('general.content.shop.wishlist_option'))
                                            <li>
                                                <a href="{{ route('customer.wishlist.index') }}" class="unset">
                                                    <i class="icon wishlist text-down-3"></i>
                                                    <span>{{ __('shop::app.header.wishlist') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (core()->getConfigData('general.content.shop.compare_option'))
                                            <li>
                                                <a href="{{ route('velocity.customer.product.compare') }}" class="unset">
                                                    <i class="icon compare text-down-3"></i>
                                                    <span>{{ __('shop::app.customer.compare.text') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        <li>
                                            <a href="{{ route('customer.orders.index') }}" class="unset">
                                                <i class="icon orders text-down-3"></i>
                                                <span>{{ __('velocity::app.shop.general.orders') }}</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('customer.downloadable_products.index') }}" class="unset">
                                                <i class="icon downloadables text-down-3"></i>
                                                <span>{{ __('velocity::app.shop.general.downloadables') }}</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('gdpr.customers.allgdpr') }}" class="unset">
                                                <i class="icon gdpr text-down-3"></i>
                                                <span>{{ __('gdpr::app.shop.customer.menu-name') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                @endauth

                                <ul type="none" class="meta-wrapper">
                                    <li>
                                        @if ($locale)
                                            <div class="language-logo-wrapper">
                                                @if ($locale->locale_image)
                                                    <img
                                                        class="language-logo"
                                                        src="{{ asset('/storage/' . $locale->locale_image) }}" alt="" />
                                                @elseif ($locale->code == "en")
                                                    <img
                                                        class="language-logo"
                                                        src="{{ asset('/themes/velocity/assets/images/flags/en.png') }}" alt="" />
                                                @endif
                                            </div>
                                            <span>{{ $locale->name }}</span>
                                        @endif

                                        <i
                                            class="rango-arrow-right"
                                            @click="toggleMetaInfo('languages')">
                                        </i>
                                    </li>

                                    <li>
                                        <span>{{ $currency->code }}</span>

                                        <i
                                            class="rango-arrow-right"
                                            @click="toggleMetaInfo('currencies')">
                                        </i>
                                    </li>

                                    <li>
                                        @auth('customer')
                                            <a
                                                class="unset"
                                                href="{{ route('customer.session.destroy') }}">
                                                <span>{{ __('shop::app.header.logout') }}</span>
                                            </a>
                                        @endauth

                                        @guest('customer')
                                            <a
                                                class="unset"
                                                href="{{ route('customer.session.create') }}">
                                                <span>{{ __('shop::app.customer.login-form.title') }}</span>
                                            </a>
                                        @endguest
                                    </li>

                                    <li>
                                        @guest('customer')
                                            <a
                                                class="unset"
                                                href="{{ route('customer.register.index') }}">
                                                <span>{{ __('shop::app.header.sign-up') }}</span>
                                            </a>
                                        @endguest
                                    </li>
                                </ul>
                            </div>

                            <div class="wrapper" v-else-if="subCategory">
                                <div class="drawer-section">
                                    <i class="rango-arrow-left fs24 text-down-4" @click="toggleSubcategories('root')"></i>

                                    <h4 class="display-inbl">@{{ subCategory.name }}</h4>

                                    <i class="material-icons float-right text-dark" @click="closeDrawer()">
                                        cancel
                                    </i>
                                </div>

                                <ul type="none">
                                    <li
                                        :key="index"
                                        v-for="(nestedSubCategory, index) in subCategory.children">

                                        <a
                                            class="unset"
                                            :href="`${$root.baseUrl}/${subCategory.slug}/${nestedSubCategory.slug}`">

                                            <div class="category-logo">
                                                <img
                                                    class="category-icon"
                                                    v-if="nestedSubCategory.category_icon_path"
                                                    :src="`${$root.baseUrl}/storage/${nestedSubCategory.category_icon_path}`" alt="" width="20" height="20" />
                                            </div>
                                            <span>@{{ nestedSubCategory.name }}</span>
                                        </a>

                                        <ul
                                            type="none"
                                            class="nested-category"
                                            v-if="nestedSubCategory.children && nestedSubCategory.children.length > 0">

                                            <li
                                                :key="`index-${Math.random()}`"
                                                v-for="(thirdLevelCategory, index) in nestedSubCategory.children">
                                                <a
                                                    class="unset"
                                                    :href="`${$root.baseUrl}/${subCategory.slug}/${nestedSubCategory.slug}/${thirdLevelCategory.slug}`">

                                                    <div class="category-logo">
                                                        <img
                                                            class="category-icon"
                                                            v-if="thirdLevelCategory.category_icon_path"
                                                            :src="`${$root.baseUrl}/storage/${thirdLevelCategory.category_icon_path}`" alt="" width="20" height="20" />
                                                    </div>
                                                    <span>@{{ thirdLevelCategory.name }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <div class="wrapper" v-else-if="languages">
                                <div class="drawer-section">
                                    <i class="rango-arrow-left fs24 text-down-4" @click="toggleMetaInfo('languages')"></i>
                                    <h4 class="display-inbl">{{ __('velocity::app.responsive.header.languages') }}</h4>
                                    <i class="material-icons float-right text-dark" @click="closeDrawer()">cancel</i>
                                </div>

                                <ul type="none">
                                    @foreach ($allLocales as $locale)
                                        <li>
                                            <a
                                                class="unset"
                                                @if (isset($serachQuery))
                                                    href="?{{ $serachQuery }}&locale={{ $locale->code }}"
                                                @else
                                                    href="?locale={{ $locale->code }}"
                                                @endif>

                                                @if( $locale->code == 'en')
                                                    <div class="category-logo">
                                                        <img
                                                        class="category-icon"
                                                        src="{{ asset('/themes/velocity/assets/images/flags/en.png') }}" alt="" width="20" height="20" />
                                                    </div>
                                                @else

                                                    <div class="category-logo">
                                                        <img
                                                        class="category-icon"
                                                        src="{{ asset('/storage/' . $locale->locale_image) }}" alt="" width="20" height="20" />
                                                    </div>
                                                @endif

                                                <span>
                                                    {{ isset($serachQuery) ? $locale->title : $locale->name }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="wrapper" v-else-if="currencies">
                                <div class="drawer-section">
                                    <i class="rango-arrow-left fs24 text-down-4" @click="toggleMetaInfo('currencies')"></i>
                                    <h4 class="display-inbl">{{ __('velocity::app.shop.general.currencies') }}</h4>
                                    <i class="material-icons float-right text-dark" @click="closeDrawer()">cancel</i>
                                </div>

                                <ul type="none">
                                    @foreach ($allCurrency as $currency)
                                        <li>
                                            @if (isset($serachQuery))
                                                <a
                                                    class="unset"
                                                    href="?{{ $serachQuery }}&locale={{ $currency->code }}">
                                                    <span>{{ $currency->code }}</span>
                                                </a>
                                            @else
                                                <a
                                                    class="unset"
                                                    href="?currency={{ $currency->code }}">
                                                    <span>{{ $currency->code }}</span>
                                                </a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="hamburger-wrapper" @click="toggleHamburger">
                            <i class="rango-toggle hamburger"></i>
                        </div>

                        <logo-component></logo-component>
                    </div>

                    @php
                        $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false;
                        $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                    @endphp

                    <div class="right-vc-header col-6">
                        @if ($showCompare)
                            <a
                                class="compare-btn unset"
                                @auth('customer')
                                    href="{{ route('velocity.customer.product.compare') }}"
                                @endauth

                                @guest('customer')
                                    href="{{ route('velocity.product.compare') }}"
                                @endguest
                                >

                                <div class="badge-container" v-if="compareCount > 0">
                                    <span class="badge" v-text="compareCount"></span>
                                </div>
                                <i class="material-icons">compare_arrows</i>
                            </a>
                        @endif

                        @if ($showWishlist)
                            <a class="wishlist-btn unset" :href="`{{ route('customer.wishlist.index') }}`">
                                <div class="badge-container" v-if="wishlistCount > 0">
                                    <span class="badge" v-text="wishlistCount"></span>
                                </div>
                                <i class="material-icons">favorite_border</i>
                            </a>
                        @endif

                        <a class="unset cursor-pointer" @click="openSearchBar">
                            <i class="material-icons">search</i>
                        </a>

                        <a href="{{ route('shop.checkout.cart.index') }}" class="unset">
                            <div class="badge-wrapper">
                                <span class="badge">@{{ cartItemsCount }}</span>
                            </div>
                            <i class="material-icons text-down-3">shopping_cart</i>
                        </a>
                    </div>

                    <searchbar-component v-if="isSearchbar"></searchbar-component>
                </div>
            </div>

            <div
               id="main-category"
                @mouseout="toggleSidebar('0', $event, 'mouseout')"
                @mouseover="toggleSidebar('0', $event, 'mouseover')"
                :class="`main-category fs16 unselectable fw6 ${($root.sharedRootCategories.length > 0) ? 'cursor-pointer' : 'cursor-not-allowed'} left`">

                <i class="rango-view-list text-down-4 align-vertical-top fs18">
                </i>
                <span
                    class="pl5"
                    v-text="heading"
                    @mouseover="toggleSidebar('0', $event, 'mouseover')">
                </span>
            </div>

            <div class="content-list right">
                <ul type="none" class="no-margin">
                    <li v-for="(content, index) in headerContent" :key="index">
                        <a
                            v-text="content.title"
                            :href="`${$root.baseUrl}/${content['page_link']}`"
                            v-if="(content['content_type'] == 'link' || content['content_type'] == 'category')"
                            :target="content['link_target'] ? '_blank' : '_self'">
                        </a>
                    </li>
                </ul>
            </div>
        </header>
    </script>
@endpush

@php
    $cart = cart()->getCart();

    $cartItemsCount = trans('shop::app.minicart.zero');

    if ($cart) {
        $cartItemsCount = $cart->items->count();
    }
@endphp

@push('scripts')
    <script type="text/javascript">
        (() => {
            Vue.component('content-header', {
                template: '#content-header-template',
                props: [
                    'heading',
                    'headerContent',
                    'categoryCount',
                ],

                data: function () {
                    return {
                        'compareCount': 0,
                        'wishlistCount': 0,
                        'languages': false,
                        'hamburger': false,
                        'currencies': false,
                        'subCategory': null,
                        'isSearchbar': false,
                        'rootCategories': true,
                        'cartItemsCount': '{{ $cartItemsCount }}',
                        'rootCategoriesCollection': this.$root.sharedRootCategories,
                        'isCustomer': '{{ auth()->guard('customer')->user() ? "true" : "false" }}' == "true",
                    }
                },

                watch: {
                    hamburger: function (value) {
                        if (value) {
                            document.body.classList.add('open-hamburger');
                        } else {
                            document.body.classList.remove('open-hamburger');
                        }
                    },

                    '$root.headerItemsCount': function () {
                        this.updateHeaderItemsCount();
                    },

                    '$root.miniCartKey': function () {
                        this.getMiniCartDetails();
                    },

                    '$root.sharedRootCategories': function (categories) {
                        this.formatCategories(categories);
                    }
                },

                created: function () {
                    this.getMiniCartDetails();
                    this.updateHeaderItemsCount();
                },

                methods: {
                    openSearchBar: function () {
                        this.isSearchbar = !this.isSearchbar;

                        let footer = $('.footer');
                        let homeContent = $('#home-right-bar-container');

                        if (this.isSearchbar) {
                            footer[0].style.opacity = '.3';
                            homeContent[0].style.opacity = '.3';
                        } else {
                            footer[0].style.opacity = '1';
                            homeContent[0].style.opacity = '1';
                        }
                    },

                    toggleHamburger: function () {
                        this.hamburger = !this.hamburger;
                    },

                    closeDrawer: function() {
                        $('.nav-container').hide();

                        this.toggleHamburger();
                        this.rootCategories = true;
                    },

                    toggleSubcategories: function (index, event) {
                        if (index == "root") {
                            this.rootCategories = true;
                            this.subCategory = false;
                        } else {
                            event.preventDefault();

                            let categories = this.$root.sharedRootCategories;
                            this.rootCategories = false;
                            this.subCategory = categories[index];
                        }
                    },

                    toggleMetaInfo: function (metaKey) {
                        this.rootCategories = ! this.rootCategories;

                        this[metaKey] = !this[metaKey];
                    },

                    updateHeaderItemsCount: function () {
                        if (! this.isCustomer) {
                            let comparedItems = this.getStorageValue('compared_product');

                            if (comparedItems) {
                                this.compareCount = comparedItems.length;
                            }
                        } else {
                            this.$http.get(`${this.$root.baseUrl}/items-count`)
                                .then(response => {
                                    this.compareCount = response.data.compareProductsCount;
                                    this.wishlistCount = response.data.wishlistedProductsCount;
                                })
                                .catch(exception => {
                                    console.log(this.__('error.something_went_wrong'));
                                });
                        }
                    },

                    getMiniCartDetails: function () {
                        this.$http.get(`${this.$root.baseUrl}/mini-cart`)
                        .then(response => {
                            if (response.data.status) {
                                this.cartItemsCount = response.data.mini_cart.cart_items.length;
                            }
                        })
                        .catch(exception => {
                            console.log(this.__('error.something_went_wrong'));
                        });
                    },

                    formatCategories: function (categories) {
                        let slicedCategories = categories;
                        let categoryCount = this.categoryCount ? this.categoryCount : 9;

                        if (
                            slicedCategories
                            && slicedCategories.length > categoryCount
                        ) {
                            slicedCategories = categories.slice(0, categoryCount);
                        }

                        this.rootCategoriesCollection = slicedCategories;
                    },
                },
            });
        })()
    </script>
@endpush