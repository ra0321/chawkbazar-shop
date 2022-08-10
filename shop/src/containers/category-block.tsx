import Card from "@components/common/card";
import SectionHeader from "@components/common/section-header";
import Carousel from "@components/ui/carousel/carousel";
import CardLoader from "@components/ui/loaders/card-loader";
import CardRoundedLoader from "@components/ui/loaders/card-rounded-loader";
import { useCategoriesQuery } from "@framework/category/categories.query";
import { ROUTES } from "@lib/routes";
import Alert from "@components/ui/alert";
import { SwiperSlide } from "swiper/react";
import isEmpty from "lodash/isEmpty";
import NotFoundItem from "@components/404/not-found-item";
import { useTranslation } from "next-i18next";
import React from "react";

interface CategoriesProps {
	sectionHeading: string;
	className?: string;
	type?: "rounded" | "circle";
}

const breakpoints = {
	"1720": {
		slidesPerView: 8,
		spaceBetween: 28,
	},
	"1400": {
		slidesPerView: 7,
		spaceBetween: 28,
	},
	"1025": {
		slidesPerView: 6,
		spaceBetween: 28,
	},
	"768": {
		slidesPerView: 5,
		spaceBetween: 20,
	},
	"500 ": {
		slidesPerView: 4,
		spaceBetween: 20,
	},
	"0": {
		slidesPerView: 3,
		spaceBetween: 12,
	},
};

const breakpointsCircle = {
	"1720": {
		slidesPerView: 8,
		spaceBetween: 48,
	},
	"1400": {
		slidesPerView: 7,
		spaceBetween: 32,
	},
	"1025": {
		slidesPerView: 6,
		spaceBetween: 28,
	},
	"768": {
		slidesPerView: 5,
		spaceBetween: 20,
	},
	"500 ": {
		slidesPerView: 4,
		spaceBetween: 20,
	},
	"0": {
		slidesPerView: 3,
		spaceBetween: 12,
	},
};

const CategoryBlock: React.FC<CategoriesProps> = ({
	className = "mb-10 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0",
	sectionHeading,
	type = "circle",
}) => {
  const { t } = useTranslation();

	const { data: categories, isLoading: loading, error } = useCategoriesQuery({
		limit: 10,
    parent: null
	});

  if (!loading && isEmpty(categories?.data)) {
    return (
      <NotFoundItem text={t("text-no-categories-found")} />
    )
  }


	return (
		<div className={className}>
			<SectionHeader sectionHeading={sectionHeading} />
			{error ? (
				<Alert message={error?.message} />
			) : (
				<Carousel
					breakpoints={type === "rounded" ? breakpoints : breakpointsCircle}
					buttonClassName="-mt-8 md:-mt-10"
				>
					{loading && !categories?.data
						? Array.from({ length: 10 }).map((_, idx) => {
								if (type === "rounded") {
									return (
										<SwiperSlide key={`card-rounded-${idx}`}>
											<CardRoundedLoader uniqueKey={`card-rounded-${idx}`} />
										</SwiperSlide>
									);
								}
								return (
									<SwiperSlide key={`card-circle-${idx}`}>
										<CardLoader uniqueKey={`card-circle-${idx}`} />
									</SwiperSlide>
								);
						  })
						: categories?.data?.map((category) => (
								<SwiperSlide key={`category--key-${category.id}`}>
									<Card
										item={category}
										href={`${ROUTES.CATEGORY}/${category.slug}`}
										variant={type}
										effectActive={true}
										size={type === "rounded" ? "medium" : "small"}
									/>
								</SwiperSlide>
						  ))}
				</Carousel>
			)}
		</div>
	);
};

export default CategoryBlock;
