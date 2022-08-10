import { GetStaticProps } from "next";
import { QueryClient } from "react-query";
import { API_ENDPOINTS } from "@framework/utils/endpoints";
import { fetchSettings } from "@framework/settings/settings.query";
import { serverSideTranslations } from "next-i18next/serverSideTranslations";
import { fetchCategories } from "@framework/category/categories.query";
import { fetchBrands } from "@framework/brand/brands.query";
import { fetchProducts } from "@framework/products/products.query";
import { siteSettings } from "@settings/site.settings";
import { fetchFeaturedCategories } from "@framework/category/featured-categories.query";
import { dehydrate } from "react-query/hydration";

export const getStaticProps: GetStaticProps = async ({ locale }) => {
  const queryClient = new QueryClient();

  await queryClient.prefetchQuery(API_ENDPOINTS.SETTINGS, fetchSettings);

  await queryClient.prefetchQuery(
    [API_ENDPOINTS.CATEGORIES, { limit: 10, parent: null }],
    fetchCategories,
    {
      staleTime: 60 * 1000,
    }
  );

  // Featured Categories
  await queryClient.prefetchQuery(
    [API_ENDPOINTS.FEATURED_CATEGORIES, { limit: 3 }],
    fetchFeaturedCategories,
    {
      staleTime: 60 * 1000,
    }
  );

  // Fetch products based on tags -> flash-sale products
  await queryClient.prefetchQuery(
    [
      API_ENDPOINTS.PRODUCTS,
      {
        limit: siteSettings?.homePageBlocks?.flashSale?.limit,
        tags: siteSettings?.homePageBlocks?.flashSale?.slug,
      },
    ],
    fetchProducts,
    {
      staleTime: 60 * 1000,
    }
  );

  // Fetch products based on tags -> featured-products products
  await queryClient.prefetchQuery(
    [
      API_ENDPOINTS.PRODUCTS,
      {
        limit: siteSettings?.homePageBlocks?.featuredProducts?.limit,
        tags: siteSettings?.homePageBlocks?.featuredProducts?.slug,
      },
    ],
    fetchProducts,
    {
      staleTime: 60 * 1000,
    }
  );

  // Fetch products based on tags -> on-sale products
  await queryClient.prefetchQuery(
    [
      API_ENDPOINTS.PRODUCTS,
      {
        limit: siteSettings?.homePageBlocks?.onSaleSettings?.limit,
        tags: siteSettings?.homePageBlocks?.onSaleSettings?.slug,
      },
    ],
    fetchProducts,
    {
      staleTime: 60 * 1000,
    }
  );

  // Fetch products based on tags -> new arrival products
  await queryClient.prefetchQuery(
    [
      API_ENDPOINTS.PRODUCTS,
      {
        limit: 10,
        orderBy: "created_at",
        sortedBy: "DESC",
      },
    ],
    fetchProducts,
    {
      staleTime: 60 * 1000,
    }
  );

  await queryClient.prefetchQuery(
    [API_ENDPOINTS.TYPE, { limit: 16 }],
    fetchBrands,
    {
      staleTime: 60 * 1000,
    }
  );

  return {
    props: {
      ...(await serverSideTranslations(locale!, [
        "common",
        "menu",
        "forms",
        "footer",
      ])),
      dehydratedState: JSON.parse(JSON.stringify(dehydrate(queryClient))),
    },
    revalidate: 120,
  };
};
