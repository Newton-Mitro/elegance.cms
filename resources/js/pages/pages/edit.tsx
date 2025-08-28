import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { CKEditor } from '@ckeditor/ckeditor5-react';
import { Head, router } from '@inertiajs/react';
import React, { useState } from 'react';
import toast from 'react-hot-toast';
import HeadingSmall from '../../components/heading-small';
import InputError from '../../components/input-error';
import { MediaSelector } from '../../components/media-selector';
import { Button } from '../../components/ui/button';
import { Input } from '../../components/ui/input';
import { Label } from '../../components/ui/label';
import { Select } from '../../components/ui/select';
import { Textarea } from '../../components/ui/text-area';
import AppLayout from '../../layouts/app-layout';
import { BreadcrumbItem } from '../../types';
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
        router.put(`/admin/pages/${page.id}`, pageForm as Record<string, any>, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Page updated successfully.');
            },
            onError: (errors) => {
                console.log(errors);
                Object.values(errors).forEach((fieldErrors: any) => {
                    if (Array.isArray(fieldErrors)) {
                        fieldErrors.forEach((message: string) => toast.error(message));
                    } else {
                        toast.error(fieldErrors);
                    }
                });
            },
            onFinish: () => {
                console.log('Request finished');
            },
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
                media: null,
                content_type: 'custom_html',
                sort_order: pageSections.length + 1,
            },
        ]);
    };

    // ✅ updated: can accept single key/value OR multiple fields
    const updateSectionField = (index: number, keyOrFields: keyof PageSection | Record<string, any>, value?: any) => {
        setPageSections((prev) => {
            const updated = [...prev];
            if (typeof keyOrFields === 'string') {
                updated[index] = { ...updated[index], [keyOrFields]: value };
            } else {
                updated[index] = { ...updated[index], ...keyOrFields };
            }
            return updated;
        });
    };

    const removeSection = (index: number) => {
        const section = pageSections[index];

        if (section.id) {
            // Only attempt delete if the section exists in DB
            router.delete(`/admin/page-sections/${section.id}`, {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success('Section deleted successfully.');
                    // Remove from UI
                    setPageSections((prev) => {
                        const updated = [...prev];
                        updated.splice(index, 1);
                        return updated;
                    });
                },
                onError: (errors) => {
                    console.error(errors);
                    toast.error('Failed to delete section.');
                },
            });
        } else {
            // Section not saved yet, just remove from UI
            setPageSections((prev) => {
                const updated = [...prev];
                updated.splice(index, 1);
                return updated;
            });
            toast.success('Section removed.');
        }
    };

    const updateSingleSection = (index: number) => {
        const section = pageSections[index];

        console.log(section);

        if (section.id === null) {
            console.log(section.id);
            router.post(
                `/admin/page-sections`,
                {
                    heading: section.heading || '',
                    sub_heading: section.sub_heading || '',
                    button_text: section.button_text || '',
                    button_link: section.button_link || '',
                    content: section.content || '',
                    page_id: page.id,
                    gallery: Array.isArray(section.gallery) ? section.gallery : [],
                    media_id: section.media_id || null,
                    content_type: section.content_type || 'custom_html',
                    sort_order: section.sort_order || 0,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        toast.success('Section saved successfully.');
                    },
                    onError: (errors) => {
                        console.log(errors);
                        Object.values(errors).forEach((fieldErrors: any) => {
                            if (Array.isArray(fieldErrors)) {
                                fieldErrors.forEach((message: string) => toast.error(message));
                            } else {
                                toast.error(fieldErrors);
                            }
                        });
                    },
                    onFinish: () => {
                        console.log('Request finished');
                    },
                },
            );
        } else {
            router.put(
                `/admin/page-sections/${section.id}`,
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
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        toast.success('Section saved successfully.');
                    },
                    onError: (errors) => {
                        Object.values(errors).forEach((fieldErrors: any) => {
                            if (Array.isArray(fieldErrors)) {
                                fieldErrors.forEach((message: string) => toast.error(message));
                            } else {
                                toast.error(fieldErrors);
                            }
                        });
                    },
                    onFinish: () => {
                        console.log('Request finished');
                    },
                },
            );
        }
    };

    const openMediaModal = (sectionIndex: number) => {
        setSelectedSectionIndex(sectionIndex);
        setMediaModalOpen(true);
    };

    // ✅ fixed: one atomic update
    const handleMediaSelect = (mediaItem: Media) => {
        if (selectedSectionIndex !== null) {
            updateSectionField(selectedSectionIndex, {
                media: mediaItem,
                media_id: mediaItem.id,
            });
        }
        setMediaModalOpen(false);
        setSelectedSectionIndex(null);
    };

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Pages', href: '/admin/pages' },
        { title: `Edit Page`, href: '' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Page" />
            <div className="h-[calc(100vh-100px)] space-y-8 overflow-auto p-6">
                {/* --- Page Metadata --- */}
                <div className="space-y-4 rounded-lg border p-4 md:w-4xl">
                    <HeadingSmall title="Edit Page" description="Edit page title, meta title, and meta description" />
                    <form onSubmit={handlePageSubmit} className="grid grid-cols-1 gap-4 md:grid-cols-3">
                        {/* Title */}
                        <div className="flex flex-col">
                            <Label htmlFor="title">Title</Label>
                            <Input
                                id="title"
                                name="title"
                                type="text"
                                value={pageForm.title}
                                onChange={(e) => setPageForm({ ...pageForm, title: e.target.value })}
                                className="mt-1 block w-full"
                                placeholder="Page title"
                                required
                            />
                            <InputError className="mt-2" message={''} />
                        </div>

                        {/* Meta Title */}
                        <div className="flex flex-col">
                            <Label htmlFor="meta_title">Meta Title</Label>
                            <Input
                                id="meta_title"
                                name="meta_title"
                                type="text"
                                value={pageForm.meta_title || ''}
                                onChange={(e) => setPageForm({ ...pageForm, meta_title: e.target.value })}
                                className="mt-1 block w-full"
                                placeholder="Meta title"
                            />
                            <InputError className="mt-2" message={''} />
                        </div>

                        {/* Meta Description */}
                        <div className="flex flex-col md:col-span-3">
                            <Label htmlFor="meta_description">Meta Description</Label>
                            <Textarea
                                id="meta_description"
                                name="meta_description"
                                value={pageForm.meta_description || ''}
                                onChange={(e) => setPageForm({ ...pageForm, meta_description: e.target.value })}
                                className="mt-1 block w-full"
                                rows={3}
                            />
                            <InputError className="mt-2" message={''} />
                        </div>

                        {/* Submit Button (full width) */}
                        <div className="md:col-span-3">
                            <Button type="submit">Update Page</Button>
                        </div>
                    </form>
                </div>

                {/* --- Page Sections --- */}
                <div className="space-y-6">
                    <HeadingSmall title="Page Sections" description="Add or remove page sections" />
                    {pageSections.map((section, index) => (
                        <div key={index} className="space-y-4 rounded-lg border p-4 md:w-4xl">
                            <div className="flex items-center justify-between">
                                <HeadingSmall title={`Section ${index + 1}`} description="Add, edit, or remove page sections" />
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
                                    <Label htmlFor={`heading_${index}`}>Heading</Label>
                                    <Input
                                        id={`heading_${index}`}
                                        name={`sections[${index}][heading]`}
                                        type="text"
                                        value={section.heading || ''}
                                        onChange={(e) => updateSectionField(index, 'heading', e.target.value)}
                                        className="mt-1 block w-full"
                                        placeholder="Heading"
                                        required
                                    />
                                </div>

                                <div className="flex flex-col">
                                    <Label htmlFor="sub_heading">Sub Heading</Label>
                                    <Input
                                        id="sub_heading"
                                        name="sub_heading"
                                        type="text"
                                        value={section.sub_heading || ''}
                                        onChange={(e) => updateSectionField(index, 'sub_heading', e.target.value)}
                                        className="mt-1 block w-full"
                                        placeholder="Sub Heading"
                                        required
                                    />
                                </div>

                                <div className="flex flex-col">
                                    <Label htmlFor="button_text">Button Text</Label>
                                    <Input
                                        id="button_text"
                                        name="button_text"
                                        type="text"
                                        value={section.button_text || ''}
                                        onChange={(e) => updateSectionField(index, 'button_text', e.target.value)}
                                        className="mt-1 block w-full"
                                        placeholder="Button Text"
                                        required
                                    />
                                </div>

                                <div className="flex flex-col">
                                    <Label htmlFor="button_link">Button Link</Label>
                                    <Input
                                        id="button_link"
                                        name="button_link"
                                        type="text"
                                        value={section.button_link || ''}
                                        onChange={(e) => updateSectionField(index, 'button_link', e.target.value)}
                                        className="mt-1 block w-full"
                                        placeholder="Button Link"
                                        required
                                    />
                                </div>
                            </div>

                            {/* Content Type */}
                            <div className="mt-2 grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div className="flex flex-col">
                                    <Label htmlFor={`content_type_${index}`}>Content Type</Label>
                                    <Select
                                        value={section.content_type || 'custom_html'}
                                        onChange={(e) => updateSectionField(index, 'content_type', e.target.value)}
                                        options={[
                                            { value: 'json_array', label: 'Json Array' },
                                            { value: 'custom_html', label: 'Custom HTML' },
                                        ]}
                                    />
                                </div>
                                <div className="flex flex-col">
                                    <Label htmlFor="sort_order">Sort Order</Label>
                                    <Input
                                        id="sort_order"
                                        name="sort_order"
                                        type="number"
                                        value={section.sort_order || 0}
                                        onChange={(e) => updateSectionField(index, 'sort_order', parseInt(e.target.value, 10))}
                                        className="mt-1 block w-full"
                                        placeholder="Sort Order"
                                        required
                                    />
                                </div>
                            </div>

                            {/* Content */}
                            <div className="mt-2">
                                <label className="mb-1 block font-medium">Content</label>
                                <CKEditor
                                    editor={ClassicEditor as any}
                                    data={section.content || ''}
                                    onChange={(_, editor) => updateSectionField(index, 'content', editor.getData())}
                                />
                            </div>

                            {/* Gallery */}
                            <div className="flex flex-col">
                                <label className="mb-1 font-medium text-gray-700 dark:text-gray-300">Gallery URLs (comma separated)</label>
                                <Input
                                    type="text"
                                    value={Array.isArray(section.gallery) ? section.gallery.join(',') : ''}
                                    onChange={(e) => updateSectionField(index, 'gallery', e.target.value.split(','))}
                                    className="mt-1 block w-full"
                                />
                            </div>

                            {/* Media */}
                            <div className="mt-2 flex flex-col">
                                <Label>Section Media</Label>
                                <MediaSelector
                                    media={section.media}
                                    onSelect={() => openMediaModal(index)}
                                    onRemove={() => {
                                        updateSectionField(index, { media: null, media_id: null });
                                    }}
                                />
                            </div>

                            {/* Update Section Button */}
                            <button
                                type="button"
                                onClick={() => updateSingleSection(index)}
                                className="mt-2 rounded bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600 dark:bg-yellow-400 dark:hover:bg-yellow-500"
                            >
                                Update This Section
                            </button>
                        </div>
                    ))}

                    <button
                        type="button"
                        onClick={addSection}
                        className="mt-4 rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600"
                    >
                        Add Section
                    </button>
                </div>

                {/* Media Modal */}
                <MediaBrowserModal isOpen={mediaModalOpen} onClose={() => setMediaModalOpen(false)} media={media} onSelect={handleMediaSelect} />
            </div>
        </AppLayout>
    );
};

export default Edit;
