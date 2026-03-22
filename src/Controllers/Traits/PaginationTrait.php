<?php

declare(strict_types = 1);
namespace App\Controllers\Traits;

trait PaginationTrait {
    protected function generatePaginationLinks($currentPage, $totalPages, $href = '?page='): string {
        if ($totalPages > 1) {
            $links = '<ul class="pagination justify-content-center mt-3">';
            $maxLinksToShow = 5;
            
            // 'Previous' button
            if ($currentPage > 1) {
                $links .= '<li class="page-item"><a class="page-link" href="' . $href . ($currentPage - 1) . '">Previous</a></li>';
            }

            $startPage = max(1, $currentPage - floor($maxLinksToShow / 2));
            $endPage = min($totalPages, $startPage + $maxLinksToShow - 1);

            // Ellipsis for the start page
            if ($startPage > 1) {
                $links .= '<li class="page-item"><a class="page-link" href="' . $href . 1 . '">1</a></li>';
                if ($startPage > 2) {
                    $links .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
            }

            // Page numbers
            for ($i = $startPage; $i <= $endPage; $i++) {
                if ($i == $currentPage) {
                    $links .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    $links .= '<li class="page-item"><a class="page-link" href="' . $href . $i . '">' . $i . '</a></li>';
                }
            }


            // Ellipsis for the last pages
            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) {
                    $links .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
                $links .= '<li class="page-item"><a class="page-link" href="' . $href . $totalPages . '">' . $totalPages . '</a></li>';
            }

            // 'Next' button
            if ($currentPage < $totalPages) {
                $links .= '<li class="page-item"><a class="page-link" href="' . $href . ($currentPage + 1) . '">Next</a></li>';
            }

            $links .= '</ul>';
            return $links;
        }
    }
}