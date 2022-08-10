import Link from "next/link";
import Image from "next/image";
import { IoIosArrowForward } from "@react-icons/all-files/io/IoIosArrowForward";
import { ROUTES } from "@lib/routes";
import { Category } from "@framework/types";
import { useTranslation } from "next-i18next";
import React from "react";

interface Props {
	category: Category;
}

const CategoryListCard: React.FC<Props> = ({ category }) => {
  const { name, image } = category;
	const { t } = useTranslation("common");
	return (
		<Link href={`${ROUTES.CATEGORY}/${category.slug}`}>
			<a className="flex justify-between items-center bg-gray-200 rounded-md px-5 2xl:px-3.5 py-3 xl:py-3.5 2xl:py-2.5 3xl:py-3.5 transition hover:bg-gray-100">
				<div className="flex items-center">
					<div className="inline-flex flex-shrink-0 2xl:w-12 2xl:h-12 3xl:w-auto 3xl:h-auto">
						<Image
							src={image?.original ?? "/assets/placeholder/category-small.svg"}
							alt={name || t("text-category-thumbnail")}
							width={60}
							height={60}
							className="bg-gray-300 object-cover rounded-full"
						/>
					</div>
					<h3 className="text-sm md:text-base 2xl:text-sm 3xl:text-base text-heading capitalize ps-2.5 md:ps-4 2xl:ps-3 3xl:ps-4">
						{name}
					</h3>
				</div>
				<div className="flex items-center">
					<div className="text-xs font-medium w-5 h-5 flex flex-shrink-0 justify-center items-center bg-gray-350 rounded 2xl:me-2">
            {category?.products_count ?? 0}
					</div>
					<IoIosArrowForward className="hidden 2xl:block text-sm text-heading" />
				</div>
			</a>
		</Link>
	);
};

export default CategoryListCard;
