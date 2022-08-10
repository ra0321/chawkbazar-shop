import Text from "@components/ui/text";
import React from "react";
import {useTranslation} from "next-i18next";
import MailchimpForm from "@components/common/mailchimp-form";

interface Props {
	className?: string;
}

const Subscription: React.FC<Props> = ({ className = "px-5 sm:px-8 md:px-16 2xl:px-24" }) => {
  const { t } = useTranslation();

	return (
		<div
			className={`${className} flex flex-col xl:flex-row justify-center xl:justify-between items-center rounded-lg bg-gray-200 py-10 md:py-14 lg:py-16`}
		>
			<div className="-mt-1.5 lg:-mt-2 xl:-mt-0.5 text-center xl:text-start mb-7 md:mb-8 lg:mb-9 xl:mb-0">
				<Text
					variant="mediumHeading"
					className="mb-2 md:mb-2.5 lg:mb-3 xl:mb-3.5"
				>
					{t(`common:text-subscribe-heading`)}
				</Text>
				<p className="text-body text-xs md:text-sm leading-6 md:leading-7">
					{t(`common:text-subscribe-description`)}
				</p>
			</div>
      <MailchimpForm layout="subscribe" />
		</div>
	);
};

export default Subscription;
