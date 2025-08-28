import { Head } from '@inertiajs/react';
import React from 'react';
import Gallery from '../../components/gallery';
import HeadingSmall from '../../components/heading-small';
import MediaPreview from '../../components/media-preview';
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
            case 'json_array':
                try {
                    const items = section.content ? JSON.parse(section.content) : [];
                    return (
                        <div className="flex flex-col gap-4">
                            {items.map((item: any, idx: number) => (
                                <div key={idx} className="flex flex-col items-start gap-3 sm:flex-row sm:items-center">
                                    {item.image && (
                                        <img
                                            src={item.image}
                                            alt={item.text || `img-${idx}`}
                                            className="h-16 w-16 flex-shrink-0 rounded object-cover"
                                        />
                                    )}
                                    {item.icon && <i className={`${item.icon} text-base`} />}
                                    <div className="flex flex-col gap-0.5 text-sm">
                                        {item.title && <p className="font-semibold">{item.title}</p>}
                                        {item.subtitle && <p className="text-gray-700">{item.subtitle}</p>}
                                        {item.question && <p className="font-semibold">{`${idx + 1}. ${item.question}`}</p>}
                                        {item.answer && <p className="text-gray-600">{`Answer: ${item.answer}`}</p>}
                                    </div>
                                </div>
                            ))}
                        </div>
                    );
                } catch {
                    return <p className="text-sm text-red-500">Invalid JSON content</p>;
                }

            default:
                return (
                    <div
                        dangerouslySetInnerHTML={{ __html: section.content || '' }}
                        className="prose prose-sm [&_table]:border [&_table]:border-gray-500 [&_td]:border [&_td]:border-gray-500 [&_th]:border [&_th]:border-gray-500"
                    />
                );
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Show Page - ${page.title}`} />
            <div className="space-y-4 p-4">
                <HeadingSmall title={page.title} description={page.meta_description || ''} />

                {sections.length > 0 ? (
                    <div className="space-y-4">
                        {sections
                            .sort((a, b) => (a.sort_order || 0) - (b.sort_order || 0))
                            .map((section, index) => (
                                <div key={section.id} className="my-10 w-full border-t-2 border-gray-900 p-3 shadow-sm lg:w-6xl">
                                    {/* Section Heading */}
                                    <div className="mb-6 flex flex-col items-center justify-center text-center">
                                        {section.heading && <h2 className="mb-1 text-2xl font-semibold">{section.heading}</h2>}
                                        {section.sub_heading && <h3 className="mb-2 text-sm text-gray-500">{section.sub_heading}</h3>}
                                    </div>

                                    {/* Media + Content */}
                                    <div className={`flex flex-col items-start gap-4 md:flex-row ${index % 2 !== 0 ? 'md:flex-row-reverse' : ''}`}>
                                        {section.media && (
                                            <div className="w-full flex-shrink-0 md:w-1/3">
                                                <MediaPreview media={section.media} />
                                            </div>
                                        )}
                                        <div className="flex-1">{renderSectionContent(section)}</div>
                                    </div>

                                    {/* Button */}
                                    {section.button_text && section.button_link && (
                                        <div className="my-6 text-center">
                                            <a
                                                href={section.button_link}
                                                className="inline-block rounded bg-blue-600 px-3 py-1 text-sm text-white hover:bg-blue-700"
                                            >
                                                {section.button_text}
                                            </a>
                                        </div>
                                    )}

                                    {/* Gallery */}
                                    {section.gallery && section.gallery.length > 0 && (
                                        <>
                                            {/* Section Heading */}
                                            <div className="mb-6 flex flex-col items-center justify-center text-center">
                                                <h2 className="mb-1 text-2xl font-semibold">Gallery</h2>
                                                <h3 className="mb-2 text-sm text-gray-500">Browse the gallery</h3>
                                            </div>
                                            <Gallery gallery={section.gallery} />
                                        </>
                                    )}
                                </div>
                            ))}
                    </div>
                ) : (
                    <p className="text-sm text-gray-500">No sections available for this page.</p>
                )}
            </div>
        </AppLayout>
    );
};

export default Show;
