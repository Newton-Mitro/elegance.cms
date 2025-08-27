import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { Head, Link, router } from '@inertiajs/react';
import { Eye, PaperclipIcon, Trash2, Upload } from 'lucide-react';
import React from 'react';
import HeadingSmall from '../../components/heading-small';
import { Select } from '../../components/ui/select';
import AppLayout from '../../layouts/app-layout';
import { BreadcrumbItem, SharedData } from '../../types';
import { Media } from '../../types/media';
import { PaginationLink } from '../../types/pagination_link';

interface PageProps extends SharedData {
    mediaItems: {
        data: Media[];
        links: PaginationLink[];
    };
}

const Index: React.FC<PageProps> = ({ mediaItems }) => {
    const deleteMedia = (id: number) => {
        if (confirm('Are you sure you want to delete this media?')) {
            router.delete(route('media-files.destroy', id));
        }
    };

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Medias', href: '/admin/media-files' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Media Files" />
            <div className="p-6">
                <div className="mb-4 flex flex-col items-start justify-between gap-2 sm:flex-row">
                    <HeadingSmall title="Media Files" description="Manage media files" />
                </div>

                <div className="mb-4 flex items-center justify-between gap-2 sm:flex-row">
                    <label className="flex cursor-pointer items-center gap-2 rounded bg-blue-900 px-3 py-1 text-sm hover:bg-blue-600">
                        <Upload className="h-4 w-4" />
                        <span>Upload</span>
                        <input type="file" className="hidden" />
                    </label>

                    <Select
                        // value={filter}
                        // onChange={(e) => setFilter(e.target.value)}
                        className="w-40 rounded border px-2 text-sm"
                        options={[
                            { value: 'all', label: 'All Types' },
                            { value: 'images', label: 'Images' },
                            { value: 'videos', label: 'Videos' },
                            { value: 'audio', label: 'Audio' },
                            { value: 'pdf', label: 'PDFs' },
                            { value: 'docs', label: 'Word/Excel/PowerPoint' },
                            { value: 'archives', label: 'Archives' },
                        ]}
                    />
                </div>

                <div className="h-[calc(100vh-300px)] overflow-auto rounded border">
                    <table className="w-full border-collapse">
                        <thead className="sticky top-0 hidden bg-accent shadow-sm md:table-header-group">
                            <tr>
                                <th className="border p-2 text-left">File Name</th>
                                <th className="border p-2 text-left">Mime</th>
                                <th className="border p-2 text-left">Preview</th>
                                <th className="border p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody className="flex flex-col md:table-row-group">
                            {mediaItems.data.map((media) => (
                                <tr key={media.id} className="flex flex-col border-b even:bg-accent md:table-row md:flex-row">
                                    {/* Title */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Media URL</label>
                                        <p>{media.url}</p>
                                    </td>

                                    {/* Mime */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Mime</label>
                                        <p>{media.file_type}</p>
                                    </td>

                                    {/* Preview */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Preview</label>
                                        {media.file_type.startsWith('image/') ? (
                                            <img
                                                src={media.url} // or media.url if you have a full URL
                                                alt={media.alt_text || media.file_name}
                                                className="h-10"
                                            />
                                        ) : (
                                            <div className="flex items-center space-x-1">
                                                <PaperclipIcon />
                                            </div>
                                        )}
                                    </td>

                                    {/* Actions */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Actions</label>
                                        <div className="flex space-x-2">
                                            <TooltipProvider>
                                                <Tooltip>
                                                    <TooltipTrigger asChild>
                                                        <Link href={route('media-files.show', media.id)} className="text-blue-500">
                                                            <Eye className="h-5 w-5" />
                                                        </Link>
                                                    </TooltipTrigger>
                                                    <TooltipContent>View</TooltipContent>
                                                </Tooltip>

                                                <Tooltip>
                                                    <TooltipTrigger asChild>
                                                        <button onClick={() => deleteMedia(media.id)} className="text-red-500">
                                                            <Trash2 className="h-5 w-5" />
                                                        </button>
                                                    </TooltipTrigger>
                                                    <TooltipContent>Delete</TooltipContent>
                                                </Tooltip>
                                            </TooltipProvider>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                {/* Pagination */}
                <div className="mt-4 flex flex-col items-center justify-between gap-2 md:flex-row">
                    <span className="text-sm text-gray-600">Showing {mediaItems.data.length} results</span>
                    <div className="flex gap-1">
                        {mediaItems.links.map((link, i) => (
                            <Link
                                key={i}
                                href={link.url || '#'}
                                className={`rounded-full px-3 py-1 text-sm ${link.active ? 'bg-blue-900 text-white' : 'bg-gray-900'}`}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            />
                        ))}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
};

export default Index;
