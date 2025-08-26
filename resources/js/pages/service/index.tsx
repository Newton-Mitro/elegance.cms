import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { Head, Link, router } from '@inertiajs/react';
import { Eye, Pencil, Trash2 } from 'lucide-react';
import React from 'react';
import AppLayout from '../../layouts/app-layout';
import { SharedData } from '../../types';
import { PaginationLink } from '../../types/pagination_link';
import { Service } from '../../types/service';

interface PageProps extends SharedData {
    services: {
        data: Service[];
        links: PaginationLink[];
    };
}

const Index: React.FC<PageProps> = ({ services }) => {
    const deleteService = (id: number) => {
        if (confirm('Are you sure you want to delete this service?')) {
            router.delete(route('services.destroy', id));
        }
    };

    console.log(services);

    return (
        <AppLayout>
            <Head title="Services" />
            <div className="p-6">
                <div className="mb-4 flex justify-between">
                    <h1 className="text-xl font-bold">Services</h1>
                    <Link href={route('services.create')} className="btn btn-primary">
                        Create Service
                    </Link>
                </div>

                <div className="h-[calc(100vh-250px)] overflow-auto rounded border">
                    <table className="w-full border-collapse">
                        <thead className="sticky top-0 hidden bg-gray-900 shadow-sm md:table-header-group">
                            <tr>
                                <th className="border p-2 text-left">Title</th>
                                <th className="border p-2 text-left">Slug</th>
                                <th className="border p-2 text-left">Status</th>
                                <th className="border p-2 text-left">Image</th>
                                <th className="border p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody className="flex flex-col md:table-row-group">
                            {services.data.map((service) => (
                                <tr key={service.id} className="flex flex-col border-b even:bg-gray-900 md:table-row md:flex-row">
                                    {/* Title */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Title</label>
                                        <p>{service.title}</p>
                                    </td>

                                    {/* Slug */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Slug</label>
                                        <p>{service.slug}</p>
                                    </td>

                                    {/* Status */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Status</label>
                                        <span
                                            className={`rounded px-2 py-0.5 text-white ${service.status === 'active' ? 'bg-green-600' : 'bg-red-600'}`}
                                        >
                                            {service.status}
                                        </span>
                                    </td>

                                    {/* Image */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Image</label>
                                        {service.media ? <img src={service.media.url} alt={service.title} className="h-10" /> : <span>-</span>}
                                    </td>

                                    {/* Actions */}
                                    <td className="border px-2 py-1">
                                        <label className="font-semibold md:hidden">Actions</label>
                                        <div className="flex space-x-2">
                                            <TooltipProvider>
                                                <Tooltip>
                                                    <TooltipTrigger asChild>
                                                        <Link href={route('services.show', service.id)} className="text-blue-500">
                                                            <Eye className="h-5 w-5" />
                                                        </Link>
                                                    </TooltipTrigger>
                                                    <TooltipContent>View</TooltipContent>
                                                </Tooltip>

                                                <Tooltip>
                                                    <TooltipTrigger asChild>
                                                        <Link href={route('services.edit', service.id)} className="text-green-500">
                                                            <Pencil className="h-5 w-5" />
                                                        </Link>
                                                    </TooltipTrigger>
                                                    <TooltipContent>Edit</TooltipContent>
                                                </Tooltip>

                                                <Tooltip>
                                                    <TooltipTrigger asChild>
                                                        <button onClick={() => deleteService(service.id)} className="text-red-500">
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
                    <span className="text-sm text-gray-600">Showing {services.data.length} results</span>
                    <div className="flex gap-1">
                        {services.links.map((link, i) => (
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
