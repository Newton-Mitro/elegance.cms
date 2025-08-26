import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { CKEditor } from '@ckeditor/ckeditor5-react';
import { Head, router } from '@inertiajs/react';
import React, { useState } from 'react';
import AppLayout from '../../layouts/app-layout';
import { Media } from '../../types/media';
import { Page } from '../../types/page';
import { PageSection } from '../../types/page_section';
import { PaginatedData } from '../../types/paginated_meta';
import MediaBrowserModal from '../media/media_browser_modal';

interface EditProps {
    page: Page;
    sections: PageSection[];
    media: PaginatedData<Media>;
}

interface PageForm {
    title: string;
    meta_title?: string | null;
    meta_description?: string | null;
}

const Edit: React.FC<EditProps> = ({ page, sections, media }) => {
    console.log(sections);
    const [pageForm, setPageForm] = useState<PageForm>({
        title: page.title || '',
        meta_title: page.meta_title || '',
        meta_description: page.meta_description || '',
    });

    const [pageSections, setPageSections] = useState<PageSection[]>(sections || []);
    const [selectedSectionIndex, setSelectedSectionIndex] = useState<number | null>(null);
    const [mediaModalOpen, setMediaModalOpen] = useState(false);

    // --- Handlers ---
    const handlePageSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        router.put(`/pages/${page.id}`, pageForm as Record<string, any>, {
            preserveScroll: true,
            preserveState: true,
        });
    };

    const addSection = () => {
        setPageSections([
            ...pageSections,
            {
                id: null,
                heading: '',
                sub_heading: '',
                button_text: '',
                button_link: '',
                content: '',
                gallery: [],
                media_id: null,
                content_type: 'custom_html',
                sort_order: pageSections.length + 1,
            },
        ]);
    };

    const updateSectionField = (index: number, key: keyof PageSection, value: any) => {
        const updated = [...pageSections];
        updated[index] = { ...updated[index], [key]: value };
        setPageSections(updated);
    };

    const removeSection = (index: number) => {
        const updated = [...pageSections];
        updated.splice(index, 1);
        setPageSections(updated);
    };

    const updateSingleSection = (index: number) => {
        const section = pageSections[index];
        router.put(
            `/pages/${page.id}/sections/${section.id || 'new'}`,
            {
                heading: section.heading || '',
                sub_heading: section.sub_heading || '',
                button_text: section.button_text || '',
                button_link: section.button_link || '',
                content: section.content || '',
                gallery: Array.isArray(section.gallery) ? section.gallery : [],
                media_id: section.media_id || null,
                content_type: section.content_type || 'custom_html',
                sort_order: section.sort_order || 0,
            },
            { preserveScroll: true, preserveState: true },
        );
    };

    const openMediaModal = (sectionIndex: number) => {
        setSelectedSectionIndex(sectionIndex);
        setMediaModalOpen(true);
    };

    const handleMediaSelect = (mediaItem: Media) => {
        if (selectedSectionIndex !== null) {
            updateSectionField(selectedSectionIndex, 'media_id', mediaItem.id);
            updateSectionField(selectedSectionIndex, 'media', mediaItem);
        }
        setMediaModalOpen(false);
        setSelectedSectionIndex(null);
    };

    return (
        <AppLayout>
            <Head title="Edit Page" />
            <div className="mx-auto max-w-6xl space-y-8 p-6">
                {/* --- Page Metadata --- */}
                <div className="space-y-4 rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                    <h1 className="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit Page</h1>
                    <form onSubmit={handlePageSubmit} className="grid grid-cols-1 gap-4 md:grid-cols-3">
                        {/* Title */}
                        <div className="flex flex-col">
                            <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input
                                type="text"
                                value={pageForm.title}
                                onChange={(e) => setPageForm({ ...pageForm, title: e.target.value })}
                                className="rounded border border-gray-300 bg-white px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-300"
                                required
                            />
                        </div>

                        {/* Meta Title */}
                        <div className="flex flex-col">
                            <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Meta Title</label>
                            <input
                                type="text"
                                value={pageForm.meta_title || ''}
                                onChange={(e) => setPageForm({ ...pageForm, meta_title: e.target.value })}
                                className="rounded border border-gray-300 bg-white px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-300"
                            />
                        </div>

                        {/* Meta Description (full width) */}
                        <div className="flex flex-col md:col-span-3">
                            <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Meta Description</label>
                            <textarea
                                value={pageForm.meta_description || ''}
                                onChange={(e) => setPageForm({ ...pageForm, meta_description: e.target.value })}
                                className="rounded border border-gray-300 bg-white px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-300"
                                rows={3}
                            />
                        </div>

                        {/* Submit Button (full width) */}
                        <div className="md:col-span-3">
                            <button
                                type="submit"
                                className="rounded bg-green-600 px-5 py-2 text-white transition hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600"
                            >
                                Update Page
                            </button>
                        </div>
                    </form>
                </div>

                {/* --- Page Sections --- */}
                <div className="space-y-6">
                    <h2 className="text-xl font-semibold text-gray-800 dark:text-gray-100">Page Sections</h2>
                    {pageSections.map((section, index) => (
                        <div key={index} className="space-y-4 rounded-lg bg-white p-5 shadow dark:bg-gray-800">
                            <div className="flex items-center justify-between">
                                <h3 className="font-medium text-gray-700 dark:text-gray-300">Section {index + 1}</h3>
                                <button
                                    type="button"
                                    onClick={() => removeSection(index)}
                                    className="text-red-500 hover:text-red-700 dark:hover:text-red-400"
                                >
                                    Remove
                                </button>
                            </div>

                            {/* Grid of inputs */}
                            <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div className="flex flex-col">
                                    <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Heading</label>
                                    <input
                                        type="text"
                                        value={section.heading || ''}
                                        onChange={(e) => updateSectionField(index, 'heading', e.target.value)}
                                        className="rounded border border-gray-300 bg-white px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-300"
                                    />
                                </div>

                                <div className="flex flex-col">
                                    <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Sub Heading</label>
                                    <input
                                        type="text"
                                        value={section.sub_heading || ''}
                                        onChange={(e) => updateSectionField(index, 'sub_heading', e.target.value)}
                                        className="rounded border border-gray-300 bg-white px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-300"
                                    />
                                </div>

                                <div className="flex flex-col">
                                    <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Button Text</label>
                                    <input
                                        type="text"
                                        value={section.button_text || ''}
                                        onChange={(e) => updateSectionField(index, 'button_text', e.target.value)}
                                        className="rounded border border-gray-300 bg-white px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-300"
                                    />
                                </div>

                                <div className="flex flex-col">
                                    <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Button Link</label>
                                    <input
                                        type="text"
                                        value={section.button_link || ''}
                                        onChange={(e) => updateSectionField(index, 'button_link', e.target.value)}
                                        className="rounded border border-gray-300 bg-white px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-300"
                                    />
                                </div>
                            </div>

                            {/* Media and gallery */}
                            <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div className="flex flex-col">
                                    <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Content Type</label>
                                    <select
                                        value={section.content_type || 'custom_html'}
                                        onChange={(e) => updateSectionField(index, 'content_type', e.target.value as PageSection['content_type'])}
                                        className="rounded border border-gray-300 bg-white px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-300"
                                    >
                                        <option value="comma_seperated_list">Comma Separated List</option>
                                        <option value="json_array_with_img_text">JSON Array with Image & Text</option>
                                        <option value="json_array_with_fa_icon_&_text">JSON Array with FA Icon & Text</option>
                                        <option value="json_array_with_question_&_answer">JSON Array with Question & Answer</option>
                                        <option value="custom_html">Custom HTML</option>
                                    </select>
                                </div>
                            </div>

                            {/* Content */}
                            <div className="mt-2">
                                <label className="mb-1 block font-medium">Content</label>
                                <div className="rounded border bg-white p-1 dark:bg-gray-800">
                                    <CKEditor
                                        editor={ClassicEditor}
                                        data={section.content || ''}
                                        onChange={(_, editor) => updateSectionField(index, 'content', editor.getData())}
                                    />
                                </div>
                            </div>

                            {/* Gallery */}
                            <div className="flex flex-col">
                                <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Gallery URLs (comma separated)</label>
                                <input
                                    type="text"
                                    value={Array.isArray(section.gallery) ? section.gallery.join(',') : ''}
                                    onChange={(e) => updateSectionField(index, 'gallery', e.target.value.split(','))}
                                    className="rounded border border-gray-300 bg-white px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring focus:ring-blue-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-300"
                                />
                            </div>

                            {/* Media*/}
                            <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div className="flex flex-col">
                                    <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Section Media</label>
                                    <button
                                        type="button"
                                        className="flex w-full items-center justify-between rounded border border-gray-300 bg-white px-3 py-2 text-left text-gray-800 hover:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:hover:border-blue-400"
                                        onClick={() => openMediaModal(index)}
                                    >
                                        {section.media_id ? `Media ID: ${section.media_id}` : '-- Select Media --'}
                                    </button>
                                    {section.media_id && (
                                        <div className="mt-2">
                                            <img
                                                src={pageSections[index].media?.url}
                                                alt={pageSections[index].media?.alt_text || 'Selected media'}
                                                className="h-32 w-full rounded border object-cover"
                                            />
                                        </div>
                                    )}
                                </div>
                            </div>

                            <button
                                type="button"
                                onClick={() => updateSingleSection(index)}
                                className="mt-2 rounded bg-yellow-500 px-4 py-2 text-white transition hover:bg-yellow-600 dark:bg-yellow-400 dark:hover:bg-yellow-500"
                            >
                                Update This Section
                            </button>
                        </div>
                    ))}

                    <button
                        type="button"
                        onClick={addSection}
                        className="mt-4 rounded bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600"
                    >
                        Add Section
                    </button>
                </div>

                <MediaBrowserModal isOpen={mediaModalOpen} onClose={() => setMediaModalOpen(false)} media={media} onSelect={handleMediaSelect} />
            </div>
        </AppLayout>
    );
};

export default Edit;
