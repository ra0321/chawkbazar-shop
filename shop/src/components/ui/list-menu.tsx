import { useTranslation } from "next-i18next";
import { IoIosArrowForward } from "@react-icons/all-files/io/IoIosArrowForward";
import Link from "./link";

const ListMenu = ({ dept, data, hasSubMenu, menuIndex }: any) => {
	const { t } = useTranslation("menu");
	return (
		<li className="relative">
			<Link
				href={data.path}
				className="flex items-center justify-between py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
			>
				{t(data.label)}
				{data.subMenu && (
					<span className="text-sm mt-0.5 shrink-0">
						<IoIosArrowForward className="text-body transition duration-300 ease-in-out group-hover:text-black" />
					</span>
				)}
			</Link>
			{hasSubMenu && (
				<SubMenu dept={dept} data={data.subMenu} menuIndex={menuIndex} />
			)}
		</li>
	);
};

const SubMenu: React.FC<any> = ({ dept, data, menuIndex }) => {
	dept = dept + 1;
	return (
		<ul className="subMenuChild shadow-subMenu bg-gray-200 absolute z-0 end-full 2xl:end-auto 2xl:start-full opacity-0 invisible top-4 w-56 py-3">
			{data?.map((menu: any, index: number) => {
				const menuName: string = `sidebar-submenu-${dept}-${menuIndex}-${index}`;

				return (
					<ListMenu
						dept={dept}
						data={menu}
						hasSubMenu={menu.subMenu}
						menuName={menuName}
						key={menuName}
						menuIndex={index}
					/>
				);
			})}
		</ul>
	);
};

export default ListMenu;
