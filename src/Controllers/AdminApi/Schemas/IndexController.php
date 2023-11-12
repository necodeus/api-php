<?php

namespace Controllers\AdminApi\Schemas;

use Controllers\BaseController;
use Libraries\Cache;
use loophp\collection\Collection;
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
    public function index(string $schema): void
    {
        performance()::measure();
        $page = $_GET['page'] ?? 1;

        $cache = new Cache();

        $tables = [
            // BLOG
            'b_categories' => BlogCategoriesRepo::class,
            'b_comments' => BlogCommentsRepo::class,
            'b_posts' => BlogPostsRepo::class,
            'b_tags' => BlogTagsRepo::class,
            // COMMON
            'c_contents' => CommonContentsRepo::class,
            'c_contents_fragments' => CommonContentsFragmentsRepo::class,
            'c_fragments' => CommonFragmentsRepo::class,
            'c_images' => CommonImagesRepo::class,
            'c_navigation_tree' => CommonNavigationTreeRepo::class,
            'c_navigations' => CommonNavigationsRepo::class,
            'c_pages' => CommonPagesRepo::class,
            'c_redirections' => CommonRedirectionsRepo::class,
            'c_resources' => CommonResourcesRepo::class,
            'c_setting_groups' => CommonSettingGroupsRepo::class,
            'c_setting_items' => CommonSettingItemsRepo::class,
            // FORUM
            'f_categories' => ForumCategoriesRepo::class,
            'f_category_tree' => ForumCategoryTreeRepo::class,
            'f_posts' => ForumPostsRepo::class,
            'f_threads' => ForumThreadsRepo::class,
            // SHOP
            's_complaints' => ShopComplaintsRepo::class,
            's_coupons' => ShopCouponsRepo::class,
            's_couriers' => ShopCouriersRepo::class,
            's_deliveries' => ShopDeliveriesRepo::class,
            's_discount_types' => ShopDiscountTypesRepo::class,
            's_invoices' => ShopInvoicesRepo::class,
            's_order_products' => ShopOrderProductsRepo::class,
            's_orders' => ShopOrdersRepo::class,
            's_parcel_lockers' => ShopParcelLockersRepo::class,
            's_payment_providers' => ShopPaymentProvidersRepo::class,
            's_payments' => ShopPaymentsRepo::class,
            's_product_attributes' => ShopProductAttributesRepo::class,
            's_product_categories' => ShopProductCategoriesRepo::class,
            's_products' => ShopProductsRepo::class,
            's_returns' => ShopReturnsRepo::class,
            's_reviews' => ShopReviewsRepo::class,
            's_shipments' => ShopShipmentsRepo::class,
            's_shipping_providers' => ShopShippingProvidersRepo::class,
            's_streets' => ShopStreetsRepo::class,
            // USER
            'u_accounts' => UserAccountsRepo::class,
            'u_authorizations' => UserAuthorizationsRepo::class,
            'u_profiles' => UserProfilesRepo::class,
            'u_roles' => UserRolesRepo::class,
            'u_sessions' => UserSessionsRepo::class,
            'u_verifications' => UserVerificationsRepo::class,
        ];

        if (in_array($schema, array_keys($tables))) {
            $records = $cache->get("AdminApi_Schemas_Index_{$schema}_{$page}");
            $recordsCount = $cache->get("AdminApi_Schemas_Index_{$schema}_count");

            if (empty($records)) {
                $repository = new $tables[$schema]();
                $records = $repository->getAll($page);
                $recordsCount = $repository->count();
                $cache->set("AdminApi_Schemas_Index_{$schema}_{$page}", $records->all(), 60);
                $cache->set("AdminApi_Schemas_Index_{$schema}_count", $recordsCount, 60);
            }
        } else {
            $records = [];
            $recordsCount = 0;
        }
        performance()::measure();

        $records = Collection::fromIterable($records);

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'columns' => array_keys($records?->first() ?? []),
            'records' => $records->all(),
            'records_count' => $recordsCount,
        ]);
    }
}