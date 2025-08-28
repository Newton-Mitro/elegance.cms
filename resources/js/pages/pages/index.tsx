import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { Head, Link } from '@inertiajs/react';
import { Eye, Pencil } from 'lucide-react';
import React from 'react';
import HeadingSmall from '../../components/heading-small';
import AppLayout from '../../layouts/app-layout';
import { BreadcrumbItem, SharedData } from '../../types';
import { Page } from '../../types/page';
import { PaginationLink } from '../../types/pagination_link';

interface PageProps extends SharedData {
    pages: {
        data: Page[];
        links: PaginationLink[];
    };
}

const Index: React.FC<PageProps> = ({ pages }) => {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Pages', href: '/admin/pages' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Pages" />
            <div className="p-6">
                <div className="mb-4 flex flex-col items-start justify-between gap-2 sm:flex-row">
                    <HeadingSmall title="Pages" description="Manage your website's pages" />
                </div>

                <div className="h-[calc(100vh-250px)] overflow-auto rounded border">
                    <table className="w-full border-collapse">
                        <thead className="sticky top-0 hidden bg-gray-900 shadow-sm md:table-header-group">
                            <tr>
                                <th className="border p-2 text-left">Title</th>
                                <th className="border p-2 text-left">Slug</th>
                                <th className="border p-2 text-left">Meta Title</th>
                                <th className="border p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody className="flex flex-col md:table-row-group">
                            {pages.data.map((page) => (
                                <tr key={page.id} className="flex flex-col border-b even:bg-gray-900 md:table-row md:flex-row">
                                    {/* Title */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Title</label>
                                        <p>{page.title}</p>
                                    </td>

                                    {/* Slug */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Slug</label>
                                        <p>{page.slug}</p>
                                    </td>

                                    {/* Meta Title */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Meta Title</label>
                                        <p>{page.meta_title}</p>
                                    </td>

                                    {/* Actions */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Actions</label>
                                        <div className="flex space-x-2">
                                            <TooltipProvider>
                                                <Tooltip>
                                                    <TooltipTrigger asChild>
                                                        <Link href={route('pages.show', page.id)} className="text-blue-500">
                                                            <Eye className="h-5 w-5" />
                                                        </Link>
                                                    </TooltipTrigger>
                                                    <TooltipContent>View</TooltipContent>
                                                </Tooltip>

                                                <Tooltip>
                                                    <TooltipTrigger asChild>
                                                        <Link href={route('pages.edit', page.id)} className="text-green-500">
                                                            <Pencil className="h-5 w-5" />
                                                        </Link>
                                                    </TooltipTrigger>
                                                    <TooltipContent>Edit</TooltipContent>
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
                    <span className="text-sm text-gray-600">Showing {pages.data.length} results</span>
                    <div className="flex gap-1">
                        {pages.links.map((link, i) => (
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
