import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { Head, Link, router } from '@inertiajs/react';
import { Eye, PaperclipIcon, Pencil, Trash2 } from 'lucide-react';
import React from 'react';
import AppLayout from '../../layouts/app-layout';
import { SharedData } from '../../types';
import { Award } from '../../types/award';
import { PaginationLink } from '../../types/pagination_link';

interface PageProps extends SharedData {
    awards: {
        data: Award[];
        links: PaginationLink[];
    };
}

const Index: React.FC<PageProps> = ({ awards }) => {
    const deleteAward = (id: number) => {
        if (confirm('Are you sure you want to delete this award?')) {
            router.delete(route('awards.destroy', id));
        }
    };

    return (
        <AppLayout>
            <Head title="Awards" />
            <div className="p-6">
                <div className="mb-4 flex justify-between">
                    <h1 className="text-xl font-bold">Awards</h1>
                    <Link href={route('awards.create')} className="btn btn-primary">
                        Create Award
                    </Link>
                </div>

                <div className="h-[calc(100vh-250px)] overflow-auto rounded border">
                    <table className="w-full border-collapse">
                        <thead className="sticky top-0 hidden bg-gray-900 shadow-sm md:table-header-group">
                            <tr>
                                <th className="border p-2 text-left">Title</th>
                                <th className="border p-2 text-left">Year</th>
                                <th className="border p-2 text-left">Image</th>
                                <th className="border p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody className="flex flex-col md:table-row-group">
                            {awards.data.map((award) => (
                                <tr key={award.id} className="flex flex-col border-b even:bg-gray-900 md:table-row md:flex-row">
                                    {/* Title */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Title</label>
                                        <p>{award.title}</p>
                                    </td>

                                    {/* Year */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Year</label>
                                        <p>{award.year}</p>
                                    </td>

                                    {/* Preview */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Preview</label>
                                        {award.image && award.image.file_type.startsWith('image/') ? (
                                            <img
                                                src={award.image.url} // or media.url if you have a full URL
                                                alt={award.image.alt_text || award.image.file_name}
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
                                                        <Link href={route('awards.show', award.id)} className="text-blue-500">
                                                            <Eye className="h-5 w-5" />
                                                        </Link>
                                                    </TooltipTrigger>
                                                    <TooltipContent>View</TooltipContent>
                                                </Tooltip>

                                                <Tooltip>
                                                    <TooltipTrigger asChild>
                                                        <Link href={route('awards.edit', award.id)} className="text-green-500">
                                                            <Pencil className="h-5 w-5" />
                                                        </Link>
                                                    </TooltipTrigger>
                                                    <TooltipContent>Edit</TooltipContent>
                                                </Tooltip>

                                                <Tooltip>
                                                    <TooltipTrigger asChild>
                                                        <button onClick={() => deleteAward(award.id)} className="text-red-500">
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
                    <span className="text-sm text-gray-600">Showing {awards.data.length} results</span>
                    <div className="flex gap-1">
                        {awards.links.map((link, i) => (
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
