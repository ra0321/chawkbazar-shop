import BrandCard from "@components/common/brand-card";
import SectionHeader from "@components/common/section-header";
import BrandCardLoader from "@components/ui/loaders/brand-card-loader";
import Alert from "@components/ui/alert";
import { useBrandsQuery } from "@framework/brand/brands.query";
import isEmpty from "lodash/isEmpty";
import NotFoundItem from "@components/404/not-found-item";
import { Type } from "@framework/types";
import { useTranslation } from "next-i18next";
import React from "react";
import { filterBrands } from "@lib/filter-brands";

interface BrandProps {
  sectionHeading: string;
  className?: string;
}

const BrandGridBlock: React.FC<BrandProps> = ({ className = "mb-12 md:mb-14 xl:mb-16", sectionHeading, }) => {
  const { t } = useTranslation();
  const { data: brands, isLoading: loading, error } = useBrandsQuery({
    limit: 16
  });


  if (!loading && isEmpty(brands?.data)) {
    return <NotFoundItem text={t("text-no-brands-found")}/>;
  }

  // Filter brands for grid layout
  const gridBrands: Type[] = filterBrands(brands?.data, "grid-layout");

  return (
    <div className={className}>
      <SectionHeader sectionHeading={sectionHeading}/>
      {error ? (
        <Alert message={error?.message}/>
      ) : (
        <div className="grid grid-cols-2 sm:grid-cols-4 gap-2.5 md:gap-3 lg:gap-5 xl:gap-7">
          {loading
            ? Array.from({ length: gridBrands?.length ?? 0 }).map((_, idx) => (
              <BrandCardLoader key={idx} uniqueKey={`top-brand-${idx}`}/>
            ))
            : gridBrands?.map((brand: Type) => (
              <BrandCard key={`brand--key${brand.id}`} brand={brand}/>
            ))}
        </div>
      )}
    </div>
  );
};

export default BrandGridBlock;
