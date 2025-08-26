import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { Head, Link, router } from '@inertiajs/react';
import { Eye, Pencil, Trash2 } from 'lucide-react';
import React from 'react';
import AppLayout from '../../layouts/app-layout';
import { SharedData } from '../../types';
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

    console.log(mediaItems);

    return (
        <AppLayout>
            <Head title="Media Files" />
            <div className="p-6">
                <div className="mb-4 flex justify-between">
                    <h1 className="text-xl font-bold">Media Files</h1>
                    <Link href={route('media-files.create')} className="btn btn-primary">
                        Upload Media
                    </Link>
                </div>

                <div className="h-[calc(100vh-250px)] overflow-auto rounded border">
                    <table className="w-full border-collapse">
                        <thead className="sticky top-0 hidden bg-gray-900 shadow-sm md:table-header-group">
                            <tr>
                                <th className="border p-2 text-left">File Name</th>
                                <th className="border p-2 text-left">Mime</th>
                                <th className="border p-2 text-left">Alt Text</th>
                                <th className="border p-2 text-left">Preview</th>
                                <th className="border p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody className="flex flex-col md:table-row-group">
                            {mediaItems.data.map((media) => (
                                <tr key={media.id} className="flex flex-col border-b even:bg-gray-900 md:table-row md:flex-row">
                                    {/* Title */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">File Name</label>
                                        <p>{media.file_name}</p>
                                    </td>

                                    {/* Year */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Mime</label>
                                        <p>{media.file_type}</p>
                                    </td>

                                    {/* Year */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Alt Text</label>
                                        <p>{media.alt_text}</p>
                                    </td>

                                    {/* Image */}
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
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    className="lucide lucide-file-text-icon lucide-file-text"
                                                >
                                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                                    <path d="M10 9H8" />
                                                    <path d="M16 13H8" />
                                                    <path d="M16 17H8" />
                                                </svg>
                                                <span className="text-sm">{media.file_name}</span>
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
                                                        <Link href={route('media-files.edit', media.id)} className="text-green-500">
                                                            <Pencil className="h-5 w-5" />
                                                        </Link>
                                                    </TooltipTrigger>
                                                    <TooltipContent>Edit</TooltipContent>
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
