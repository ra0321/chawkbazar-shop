import Link from "@components/ui/link";
import Image from "next/image";
import Text from "@components/ui/text";
import { useTranslation } from "next-i18next";
import { CollectionBanner } from "@framework/types";

interface Props {
	imgWidth?: number | string;
	imgHeight?: number | string;
	contactClassName?: string;
	collection: CollectionBanner
}

const CollectionCard: React.FC<Props> = ({
	collection,
	imgWidth = 580,
	imgHeight = 580,
	contactClassName = "",
}) => {
	const { slug, image, title, description } = collection;
	const { t } = useTranslation("common");
	return (
		<Link
			href={slug}
			className="group text-center flex flex-col justify-between sm:even:flex-col-reverse sm:last:hidden lg:last:flex border sm:border-0 border-gray-300 overflow-hidden rounded-md pb-4 sm:pb-0"
		>
			<div className="flex mx-auto flex-col relative">
				<div className="flex">
					<Image
						src={image ?? "/assets/placeholder/collection.svg"}
						alt={t(`${title}`) || t("text-card-thumbnail")}
						width={imgWidth}
						height={imgHeight}
						className="bg-gray-300 object-cover sm:rounded-md transition duration-200 ease-in-out group-hover:opacity-90"
					/>
				</div>
				<div className="overflow-hidden absolute bottom-3.5 lg:bottom-5 end-3.5 lg:end-5 p-2">
					<span className="inline-block text-[13px] md:text-sm leading-4 cursor-pointer transition ease-in-out duration-300 font-semibold text-center rounded-md bg-white text-heading shadow-navigation py-3 lg:py-4 px-4 lg:px-6 hover:bg-heading hover:text-white transform lg:translate-y-full lg:opacity-0 lg:group-hover:opacity-100 lg:group-hover:translate-y-0">
						{t("button-view-collection")}
					</span>
				</div>
			</div>
			<div className={contactClassName}>
				<Text
					variant="mediumHeading"
					className="mb-1.5 lg:mb-2.5 2xl:mb-3 3xl:mb-3.5"
				>
					{t(`${title}`)}
				</Text>
				<p className="text-body text-xs md:text-sm leading-6 md:leading-7 xl:px-10 3xl:px-20">
					{t(`${description}`)}
				</p>
			</div>
		</Link>
	);
};

export default CollectionCard;
