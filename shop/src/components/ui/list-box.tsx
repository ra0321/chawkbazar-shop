import { Fragment, useState, useEffect } from "react";
import { Listbox, Transition } from "@headlessui/react";
import { HiOutlineSelector } from "@react-icons/all-files/hi/HiOutlineSelector";
import { HiCheck } from "@react-icons/all-files/hi/HiCheck";
import { useTranslation } from "next-i18next";
import { useRouter } from "next/router";
type Option = {
  name: string;
  value: string;
};

export default function ListBox({ options }: { options: Option[] }) {
  const { t } = useTranslation("common");
  const router = useRouter();
  const { pathname, query } = router;
  const currentSelectedItem =
    query?.orderBy && query?.sortedBy
      ? options.find((o) => o.value === `${query.orderBy}|${query.sortedBy}`)!
      : options[0];
  const [selectedItem, setSelectedItem] = useState<Option>(currentSelectedItem);

  useEffect(() => {
    setSelectedItem(currentSelectedItem);
  }, [query?.orderBy, query?.sortedBy]);

  function handleItemClick(values: Option) {
    setSelectedItem(values);
    const { orderBy, sortedBy, ...restQuery } = query;
    const splitValues = values.value.split("|");
    router.push(
      {
        pathname,
        query: {
          ...restQuery,
          ...(values.value !== options[0].value
            ? { orderBy: splitValues[0], sortedBy: splitValues[1] }
            : {}),
        },
      },
      undefined,
      { scroll: false }
    );
  }

  return (
    <Listbox value={selectedItem} onChange={handleItemClick}>
      {({ open }) => (
        <div className="relative ms-2 lg:ms-0 z-10 min-w-[180px]">
          <Listbox.Button className="border border-gray-300  text-heading text-[13px] md:text-sm font-semibold  relative w-full py-2 ps-3 pe-10 text-start bg-white rounded-lg shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 sm:text-sm cursor-pointer">
            <span className="block truncate">{t(selectedItem.name)}</span>
            <span className="absolute inset-y-0 end-0 flex items-center pe-2 pointer-events-none">
              <HiOutlineSelector
                className="w-5 h-5 text-gray-400"
                aria-hidden="true"
              />
            </span>
          </Listbox.Button>
          <Transition
            show={open}
            as={Fragment}
            leave="transition ease-in duration-100"
            leaveFrom="opacity-100"
            leaveTo="opacity-0"
          >
            <Listbox.Options
              static
              className="absolute w-full py-1 mt-1 overflow-auto bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none text-sm"
            >
              {options?.map((option, personIdx) => (
                <Listbox.Option
                  key={personIdx}
                  className={({ active }) =>
                    `${active ? "text-amber-900 bg-gray-100" : "text-gray-900"}
                          cursor-pointer select-none relative py-2 ps-10 pe-4`
                  }
                  value={option}
                >
                  {({ selected, active }) => (
                    <>
                      <span
                        className={`${
                          selected ? "font-medium" : "font-normal"
                        } block truncate`}
                      >
                        {t(option.name)}
                      </span>
                      {selected && (
                        <span
                          className={`${active && "text-amber-600"}
                                check-icon absolute inset-y-0 start-0 flex items-center ps-3`}
                        >
                          <HiCheck className="w-5 h-5" aria-hidden="true" />
                        </span>
                      )}
                    </>
                  )}
                </Listbox.Option>
              ))}
            </Listbox.Options>
          </Transition>
        </div>
      )}
    </Listbox>
  );
}
