<?php

namespace Controllers\AdminApi\Schemas;

use Controllers\BaseController;
use Libraries\Cache;
use Repositories\Blog\BlogCategoriesRepo;
use Repositories\Blog\BlogCommentsRepo;
use Repositories\Blog\BlogPostsRepo;
use Repositories\Blog\BlogTagsRepo;

use Repositories\Common\CommonContentsRepo;
use Repositories\Common\CommonContentsFragmentsRepo;
use Repositories\Common\CommonFragmentsRepo;
use Repositories\Common\CommonImagesRepo;
use Repositories\Common\CommonNavigationTreeRepo;
use Repositories\Common\CommonNavigationsRepo;
use Repositories\Common\CommonPagesRepo;
use Repositories\Common\CommonRedirectionsRepo;
use Repositories\Common\CommonResourcesRepo;
use Repositories\Common\CommonSettingGroupsRepo;
use Repositories\Common\CommonSettingItemsRepo;

use Repositories\Forum\ForumCategoriesRepo;
use Repositories\Forum\ForumCategoryTreeRepo;
use Repositories\Forum\ForumPostsRepo;
use Repositories\Forum\ForumThreadsRepo;

use Repositories\Shop\ShopComplaintsRepo;
use Repositories\Shop\ShopCouponsRepo;
use Repositories\Shop\ShopCouriersRepo;
use Repositories\Shop\ShopDeliveriesRepo;
use Repositories\Shop\ShopDiscountTypesRepo;
use Repositories\Shop\ShopInvoicesRepo;
use Repositories\Shop\ShopOrderProductsRepo;
use Repositories\Shop\ShopOrdersRepo;
use Repositories\Shop\ShopParcelLockersRepo;
use Repositories\Shop\ShopPaymentProvidersRepo;
use Repositories\Shop\ShopPaymentsRepo;
use Repositories\Shop\ShopProductAttributesRepo;
use Repositories\Shop\ShopProductCategoriesRepo;
use Repositories\Shop\ShopProductsRepo;
use Repositories\Shop\ShopReturnsRepo;
use Repositories\Shop\ShopReviewsRepo;
use Repositories\Shop\ShopShipmentsRepo;
use Repositories\Shop\ShopShippingProvidersRepo;
use Repositories\Shop\ShopStreetsRepo;

use Repositories\User\UserAccountsRepo;
use Repositories\User\UserAuthorizationsRepo;
use Repositories\User\UserProfilesRepo;
use Repositories\User\UserRolesRepo;
use Repositories\User\UserSessionsRepo;
use Repositories\User\UserVerificationsRepo;

/**
 * Obsługa stron z listami rekordów wybranej tabeli z bazy danych.
 * Służy do podglądu zawartości tabeli.
 */
class IndexController extends BaseController
{
    private BlogCategoriesRepo $b_categories;
    private BlogCommentsRepo $b_comments;
    private BlogPostsRepo $b_posts;
    private BlogTagsRepo $b_tags;

    private CommonContentsRepo $c_contents;
    private CommonContentsFragmentsRepo $c_contents_fragments;
    private CommonFragmentsRepo $c_fragments;
    private CommonImagesRepo $c_images;
    private CommonNavigationTreeRepo $c_navigation_tree;
    private CommonNavigationsRepo $c_navigations;
    private CommonPagesRepo $c_pages;
    private CommonRedirectionsRepo $c_redirections;
    private CommonResourcesRepo $c_resources;
    private CommonSettingGroupsRepo $c_setting_groups;
    private CommonSettingItemsRepo $c_setting_items;

    private ForumCategoriesRepo $f_categories;
    private ForumCategoryTreeRepo $f_category_tree;
    private ForumPostsRepo $f_posts;
    private ForumThreadsRepo $f_threads;

    private ShopComplaintsRepo $s_complaints;
    private ShopCouponsRepo $s_coupons;
    private ShopCouriersRepo $s_couriers;
    private ShopDeliveriesRepo $s_deliveries;
    private ShopDiscountTypesRepo $s_discount_types;
    private ShopInvoicesRepo $s_invoices;
    private ShopOrderProductsRepo $s_order_products;
    private ShopOrdersRepo $s_orders;
    private ShopParcelLockersRepo $s_parcel_lockers;
    private ShopPaymentProvidersRepo $s_payment_providers;
    private ShopPaymentsRepo $s_payments;
    private ShopProductAttributesRepo $s_product_attributes;
    private ShopProductCategoriesRepo $s_product_categories;
    private ShopProductsRepo $s_products;
    private ShopReturnsRepo $s_returns;
    private ShopReviewsRepo $s_reviews;
    private ShopShipmentsRepo $s_shipments;
    private ShopShippingProvidersRepo $s_shipping_providers;
    private ShopStreetsRepo $s_streets;

    private UserAccountsRepo $u_accounts;
    private UserAuthorizationsRepo $u_authorizations;
    private UserProfilesRepo $u_profiles;
    private UserRolesRepo $u_roles;
    private UserSessionsRepo $u_sessions;
    private UserVerificationsRepo $u_verifications;

    public function index(string $schema): void
    {
        performance()::measure();
        switch ($schema) {
            case 'b_categories':
                $this->b_categories = new BlogCategoriesRepo();
                $all = $this->b_categories->getCategories();
                break;
            case 'b_comments':
                $this->b_comments = new BlogCommentsRepo();
                $all = $this->b_comments->getComments();
                break;
            case 'b_posts':
                $this->b_posts = new BlogPostsRepo();
                $all = $this->b_posts->getPosts();
                break;
            case 'b_tags':
                $this->b_tags = new BlogTagsRepo();
                $all = $this->b_tags->getTags();
                break;
            case 'c_contents':
                $this->c_contents = new CommonContentsRepo();
                $all = $this->c_contents->getContents();
                break;
            case 'c_contents_fragments':
                $this->c_contents_fragments = new CommonContentsFragmentsRepo();
                $all = $this->c_contents_fragments->getContentsFragments();
                break;
            case 'c_fragments':
                $this->c_fragments = new CommonFragmentsRepo();
                $all = $this->c_fragments->getFragments();
                break;
            case 'c_images':
                $this->c_images = new CommonImagesRepo();
                $all = $this->c_images->getImages();
                break;
            case 'c_navigation_tree':
                $this->c_navigation_tree = new CommonNavigationTreeRepo();
                $all = $this->c_navigation_tree->getNavigationTree();
                break;
            case 'c_navigations':
                $this->c_navigations = new CommonNavigationsRepo();
                $all = $this->c_navigations->getNavigations();
                break;
            case 'c_pages':
                $this->c_pages = new CommonPagesRepo();
                $all = $this->c_pages->getPages();
                break;
            case 'c_redirections':
                $this->c_redirections = new CommonRedirectionsRepo();
                $all = $this->c_redirections->getRedirections();
                break;
            case 'c_resources':
                $this->c_resources = new CommonResourcesRepo();
                $all = $this->c_resources->getResources();
                break;
            case 'c_setting_groups':
                $this->c_setting_groups = new CommonSettingGroupsRepo();
                $all = $this->c_setting_groups->getSettingGroups();
                break;
            case 'c_setting_items':
                $this->c_setting_items = new CommonSettingItemsRepo();
                $all = $this->c_setting_items->getSettingItems();
                break;
            case 'f_categories':
                $this->f_categories = new ForumCategoriesRepo();
                $all = $this->f_categories->getCategories();
                break;
            case 'f_category_tree':
                $this->f_category_tree = new ForumCategoryTreeRepo();
                $all = $this->f_category_tree->getCategoryTree();
                break;
            case 'f_posts':
                $this->f_posts = new ForumPostsRepo();
                $all = $this->f_posts->getPosts();
                break;
            case 'f_threads':
                $this->f_threads = new ForumThreadsRepo();
                $all = $this->f_threads->getThreads();
                break;
            case 's_complaints':
                $this->s_complaints = new ShopComplaintsRepo();
                $all = $this->s_complaints->getComplaints();
                break;
            case 's_coupons':
                $this->s_coupons = new ShopCouponsRepo();
                $all = $this->s_coupons->getCoupons();
                break;
            case 's_couriers':
                $this->s_couriers = new ShopCouriersRepo();
                $all = $this->s_couriers->getCouriers();
                break;
            case 's_deliveries':
                $this->s_deliveries = new ShopDeliveriesRepo();
                $all = $this->s_deliveries->getDeliveries();
                break;
            case 's_discount_types':
                $this->s_discount_types = new ShopDiscountTypesRepo();
                $all = $this->s_discount_types->getDiscountTypes();
                break;
            case 's_invoices':
                $this->s_invoices = new ShopInvoicesRepo();
                $all = $this->s_invoices->getInvoices();
                break;
            case 's_order_products':
                $this->s_order_products = new ShopOrderProductsRepo();
                $all = $this->s_order_products->getOrderProducts();
                break;
            case 's_orders':
                $this->s_orders = new ShopOrdersRepo();
                $all = $this->s_orders->getOrders();
                break;
            case 's_parcel_lockers':
                $this->s_parcel_lockers = new ShopParcelLockersRepo();
                $all = $this->s_parcel_lockers->getParcelLockers();
                break;
            case 's_payment_providers':
                $this->s_payment_providers = new ShopPaymentProvidersRepo();
                $all = $this->s_payment_providers->getPaymentProviders();
                break;
            case 's_payments':
                $this->s_payments = new ShopPaymentsRepo();
                $all = $this->s_payments->getPayments();
                break;
            case 's_product_attributes':
                $this->s_product_attributes = new ShopProductAttributesRepo();
                $all = $this->s_product_attributes->getProductAttributes();
                break;
            case 's_product_categories':
                $this->s_product_categories = new ShopProductCategoriesRepo();
                $all = $this->s_product_categories->getProductCategories();
                break;
            case 's_products':
                $this->s_products = new ShopProductsRepo();
                $all = $this->s_products->getProducts();
                break;
            case 's_returns':
                $this->s_returns = new ShopReturnsRepo();
                $all = $this->s_returns->getReturns();
                break;
            case 's_reviews':
                $this->s_reviews = new ShopReviewsRepo();
                $all = $this->s_reviews->getReviews();
                break;
            case 's_shipments':
                $this->s_shipments = new ShopShipmentsRepo();
                $all = $this->s_shipments->getShipments();
                break;
            case 's_shipping_providers':
                $this->s_shipping_providers = new ShopShippingProvidersRepo();
                $all = $this->s_shipping_providers->getShippingProviders();
                break;
            case 's_streets':
                $this->s_streets = new ShopStreetsRepo();
                $all = $this->s_streets->getStreets();
                break;
            case 'u_accounts':
                $this->u_accounts = new UserAccountsRepo();
                $all = $this->u_accounts->getAccounts();
                break;
            case 'u_authorizations':
                $this->u_authorizations = new UserAuthorizationsRepo();
                $all = $this->u_authorizations->getAuthorizations();
                break;
            case 'u_profiles':
                $this->u_profiles = new UserProfilesRepo();
                $all = $this->u_profiles->getProfiles();
                break;
            case 'u_roles':
                $this->u_roles = new UserRolesRepo();
                $all = $this->u_roles->getRoles();
                break;
            case 'u_sessions':
                $this->u_sessions = new UserSessionsRepo();
                $all = $this->u_sessions->getSessions();
                break;
            case 'u_verifications':
                $this->u_verifications = new UserVerificationsRepo();
                $all = $this->u_verifications->getVerifications();
                break;
            default:
                $all = [];
                break;
        }
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'all' => $all,
        ]);
    }

    /**
     * Returns number of record in each table.
     */
    public function stats()
    {
        performance()::measure();
        $cache = new Cache();
        $response = $cache->get('AdminApi_Schemas_Stats');

        if (empty($response)) {
            $this->b_categories = new BlogCategoriesRepo();
            $this->b_comments = new BlogCommentsRepo();
            $this->b_posts = new BlogPostsRepo();
            $this->b_tags = new BlogTagsRepo();
            $this->c_contents = new CommonContentsRepo();
            $this->c_contents_fragments = new CommonContentsFragmentsRepo();
            $this->c_fragments = new CommonFragmentsRepo();
            $this->c_images = new CommonImagesRepo();
            $this->c_navigation_tree = new CommonNavigationTreeRepo();
            $this->c_navigations = new CommonNavigationsRepo();
            $this->c_pages = new CommonPagesRepo();
            $this->c_redirections = new CommonRedirectionsRepo();
            $this->c_resources = new CommonResourcesRepo();
            $this->c_setting_groups = new CommonSettingGroupsRepo();
            $this->c_setting_items = new CommonSettingItemsRepo();
            $this->f_categories = new ForumCategoriesRepo();
            $this->f_category_tree = new ForumCategoryTreeRepo();
            $this->f_posts = new ForumPostsRepo();
            $this->f_threads = new ForumThreadsRepo();
            $this->s_complaints = new ShopComplaintsRepo();
            $this->s_coupons = new ShopCouponsRepo();
            $this->s_couriers = new ShopCouriersRepo();
            $this->s_deliveries = new ShopDeliveriesRepo();
            $this->s_discount_types = new ShopDiscountTypesRepo();
            $this->s_invoices = new ShopInvoicesRepo();
            $this->s_order_products = new ShopOrderProductsRepo();
            $this->s_orders = new ShopOrdersRepo();
            $this->s_parcel_lockers = new ShopParcelLockersRepo();
            $this->s_payment_providers = new ShopPaymentProvidersRepo();
            $this->s_payments = new ShopPaymentsRepo();
            $this->s_product_attributes = new ShopProductAttributesRepo();
            $this->s_product_categories = new ShopProductCategoriesRepo();
            $this->s_products = new ShopProductsRepo();
            $this->s_returns = new ShopReturnsRepo();
            $this->s_reviews = new ShopReviewsRepo();
            $this->s_shipments = new ShopShipmentsRepo();
            $this->s_shipping_providers = new ShopShippingProvidersRepo();
            $this->s_streets = new ShopStreetsRepo();
            $this->u_accounts = new UserAccountsRepo();
            $this->u_authorizations = new UserAuthorizationsRepo();
            $this->u_profiles = new UserProfilesRepo();
            $this->u_roles = new UserRolesRepo();
            $this->u_sessions = new UserSessionsRepo();
            $this->u_verifications = new UserVerificationsRepo();

            $response = [
                'b_categories' => $this->b_categories->countCategories(),
                'b_comments' => $this->b_comments->countComments(),
                'b_posts' => $this->b_posts->countPosts(),
                'b_tags' => $this->b_tags->countTags(),
                'c_contents' => $this->c_contents->countContents(),
                'c_contents_fragments' => $this->c_contents_fragments->countContentsFragments(),
                'c_fragments' => $this->c_fragments->countFragments(),
                'c_images' => $this->c_images->countImages(),
                'c_navigation_tree' => $this->c_navigation_tree->countNavigationTree(),
                'c_navigations' => $this->c_navigations->countNavigations(),
                'c_pages' => $this->c_pages->countPages(),
                'c_redirections' => $this->c_redirections->countRedirections(),
                'c_resources' => $this->c_resources->countResources(),
                'c_setting_groups' => $this->c_setting_groups->countSettingGroups(),
                'c_setting_items' => $this->c_setting_items->countSettingItems(),
                'f_categories' => $this->f_categories->countCategories(),
                'f_category_tree' => $this->f_category_tree->countCategoryTree(),
                'f_posts' => $this->f_posts->countPosts(),
                'f_threads' => $this->f_threads->countThreads(),
                's_complaints' => $this->s_complaints->countComplaints(),
                's_coupons' => $this->s_coupons->countCoupons(),
                's_couriers' => $this->s_couriers->countCouriers(),
                's_deliveries' => $this->s_deliveries->countDeliveries(),
                's_discount_types' => $this->s_discount_types->countDiscountTypes(),
                's_invoices' => $this->s_invoices->countInvoices(),
                's_order_products' => $this->s_order_products->countOrderProducts(),
                's_orders' => $this->s_orders->countOrders(),
                's_parcel_lockers' => $this->s_parcel_lockers->countParcelLockers(),
                's_payment_providers' => $this->s_payment_providers->countPaymentProviders(),
                's_payments' => $this->s_payments->countPayments(),
                's_product_attributes' => $this->s_product_attributes->countProductAttributes(),
                's_product_categories' => $this->s_product_categories->countProductCategories(),
                's_products' => $this->s_products->countProducts(),
                's_returns' => $this->s_returns->countReturns(),
                's_reviews' => $this->s_reviews->countReviews(),
                's_shipments' => $this->s_shipments->countShipments(),
                's_shipping_providers' => $this->s_shipping_providers->countShippingProviders(),
                's_streets' => $this->s_streets->countStreets(),
                'u_accounts' => $this->u_accounts->countAccounts(),
                'u_authorizations' => $this->u_authorizations->countAuthorizations(),
                'u_profiles' => $this->u_profiles->countProfiles(),
                'u_roles' => $this->u_roles->countRoles(),
                'u_sessions' => $this->u_sessions->countSessions(),
                'u_verifications' => $this->u_verifications->countVerifications(),
            ];

            $cache->set('AdminApi_Schemas_Stats', $response, 60);
        }
        performance()::measure();

        @header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'all' => $response,
        ]);
    }
}