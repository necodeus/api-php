<?php

namespace Repositories;
use Enums\ImageTypeEnum;

class CommonRepository extends BaseRepository
{
    /** ==========================================================
     * C O N T E N T  F R A G M E N T S
     * ======================================================== */

    // public function getContentFragments(): array
    // {
    //     return [];
    // }

    // public function getContentFragmentsCount(): int
    // {
    //     return 0;
    // }

    /** ==========================================================
     * C O N T E N T S
     * ======================================================== */

    // public function getContents(): array
    // {
    //     return [];
    // }

    // public function getContentsCount(): int
    // {
    //     return 0;
    // }

    /** ==========================================================
     * F R A G M E N T S
     * ======================================================== */

    // public function getFragments(): array
    // {
    //     return [];
    // }

    // public function getFragmentsCount(): int
    // {
    //     return 0;
    // }

    /** ==========================================================
     * I M A G E S
     * ======================================================== */

    // public function getImages(): array
    // {
    //     return [];
    // }

    // public function getImagesCount(): int
    // {
    //     return 0;
    // }

    public function uploadImage(string $name, ImageTypeEnum $path): bool
    {
        return false;
    }

    /** ==========================================================
     * N A V I G A T I O N S
     * ======================================================== */

    // public function getNavigations(): array
    // {
    //     return [];
    // }

    // public function getNavigationsCount(): int
    // {
    //     return 0;
    // }

    /** ==========================================================
     * N A V I G A T I O N  T R E E
     * ======================================================== */

    // public function getNavigationTree(): array
    // {
    //     return [];
    // }

    // public function getNavigationTreeCount(): int
    // {
    //     return 0;
    // }

    /** ==========================================================
     * P A G E S
     * ======================================================== */

    // public function getPages(): array
    // {
    //     return [];
    // }

    // public function getPagesCount(): int
    // {
    //     return 0;
    // }

    public function getPageBySlug(string $slug): array
    {
        $query = "SELECT *
            FROM c_pages
            WHERE
                slug = :slug
        ";

        return $this->db->fetch($query, [
            'slug' => $slug,
        ]);
    }

    // public function getPageById(string $id): array
    // {
    //     return [];
    // }

    /** ==========================================================
     * R E D I R E C T I O N S
     * ======================================================== */

    // public function getRedirections(): array
    // {
    //     return [];
    // }

    // public function getRedirectionsCount(): int
    // {
    //     return 0;
    // }

    public function getRedirectionById(string $id): array
    {
        return [];
    }

    /** ==========================================================
     * R E S O U R C E S
     * ======================================================== */

    // public function getResources(): array
    // {
    //     return [];
    // }

    // public function getResourcesCount(): int
    // {
    //     return 0;
    // }

    /** ==========================================================
     * S E T T I N G  G R O U P S
     * ======================================================== */

    // public function getSettingGroups(): array
    // {
    //     return [];
    // }

    // public function getSettingGroupsCount(): int
    // {
    //     return 0;
    // }

    /** ==========================================================
     * S E T T I N G  I T E M S
     * ======================================================== */

    // public function getSettingItems(): array
    // {
    //     return [];
    // }

    // public function getSettingItemsCount(): int
    // {
    //     return 0;
    // }
}
