import { Head } from '@inertiajs/react';
import React from 'react';
import AppLayout from '../../layouts/app-layout';
import { BreadcrumbItem } from '../../types';
import { Page } from '../../types/page';
import { PageSection } from '../../types/page_section';

interface PageProps {
    page: Page;
    sections: PageSection[];
}

const Show: React.FC<PageProps> = ({ page, sections }) => {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Pages', href: '/admin/pages' },
        { title: 'View Page', href: '' },
    ];

    const renderSectionContent = (section: PageSection) => {
        switch (section.content_type) {
            case 'comma_seperated_list':
                return (
                    <ul className="ml-5 list-disc">
                        {section.content?.split(',').map((item, idx) => (
                            <li key={idx}>{item.trim()}</li>
                        ))}
                    </ul>
                );
            case 'json_array_with_img_text':
            case 'json_array_with_fa_icon_&_text':
            case 'json_array_with_question_&_answer':
                try {
                    const items = section.content ? JSON.parse(section.content) : [];
                    return (
                        <div className="grid gap-4">
                            {items.map((item: any, idx: number) => (
                                <div key={idx}>
                                    {item.img && <img src={item.img} alt="" className="h-20 w-20 object-cover" />}
                                    {item.icon && <i className={item.icon}></i>}
                                    {item.text && <p>{item.text}</p>}
                                    {item.question && <p className="font-bold">{item.question}</p>}
                                    {item.answer && <p>{item.answer}</p>}
                                </div>
                            ))}
                        </div>
                    );
                } catch {
                    return <p>Invalid JSON content</p>;
                }
            case 'custom_html':
                return <div dangerouslySetInnerHTML={{ __html: section.content || '' }} />;
            default:
                return <p>{section.content}</p>;
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Show Page" />
            <div className="p-6">
                <h1 className="mb-2 text-xl font-bold">{page.title}</h1>
                <p className="mb-2 text-gray-600">{page.meta_title}</p>
                <p className="mb-6">{page.meta_description}</p>

                {sections.length > 0 ? (
                    <div className="space-y-8">
                        {sections
                            .sort((a, b) => (a.sort_order || 0) - (b.sort_order || 0))
                            .map((section) => (
                                <div key={section.id} className="rounded-lg border p-4">
                                    {section.heading && <h2 className="mb-2 text-lg font-semibold">{section.heading}</h2>}
                                    {section.sub_heading && <h3 className="text-md mb-2 text-gray-500">{section.sub_heading}</h3>}
                                    {renderSectionContent(section)}
                                    {section.button_text && section.button_link && (
                                        <a
                                            href={section.button_link}
                                            className="mt-2 inline-block rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                                        >
                                            {section.button_text}
                                        </a>
                                    )}
                                    {/* {section.gallery && section.gallery.length > 0 && (
                                        <div className="mt-4 grid grid-cols-2 gap-2 md:grid-cols-4">
                                            {section.gallery.map((img, idx) => (
                                                <img key={idx} src={img} alt="" className="h-32 w-full rounded object-cover" />
                                            ))}
                                        </div>
                                    )} */}
                                </div>
                            ))}
                    </div>
                ) : (
                    <p>No sections available for this page.</p>
                )}
            </div>
        </AppLayout>
    );
};

export default Show;
