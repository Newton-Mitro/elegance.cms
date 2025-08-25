import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/react';
import React from 'react';
import { SharedData } from '../../types';
import { Award } from '../../types/award';
import { PaginationLink } from '../../types/pagination_link';

interface PageProps extends SharedData {
    awards: {
        data: Award[];
        links: PaginationLink[];
        // auth: SharedData['auth'];
    };
}

const Index: React.FC<PageProps> = ({ awards }) => {
    //  const { auth } = usePage<SharedData>().props;

    const deleteAward = (id: number) => {
        if (confirm('Are you sure you want to delete this award?')) {
            Inertia.delete(route('awards.destroy', id));
        }
    };

    return (
        <div className="p-6">
            <div className="mb-4 flex justify-between">
                <h1 className="text-xl font-bold">Awards</h1>
                <Link href={route('awards.create')} className="btn btn-primary">
                    Create Award
                </Link>
            </div>

            <table className="w-full table-auto border">
                <thead>
                    <tr>
                        <th className="p-2">Title</th>
                        <th className="p-2">Year</th>
                        <th className="p-2">Image</th>
                        <th className="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {awards.data.map((award) => (
                        <tr key={award.id} className="border-t">
                            <td className="p-2">{award.title}</td>
                            <td className="p-2">{award.year}</td>
                            <td className="p-2">{award.image ? <img src={award.image.url} alt={award.title} className="h-10" /> : '-'}</td>
                            <td className="space-x-2 p-2">
                                <Link href={route('awards.show', award.id)} className="text-blue-500">
                                    View
                                </Link>
                                <Link href={route('awards.edit', award.id)} className="text-green-500">
                                    Edit
                                </Link>
                                {/* Option 1: Delete via Link */}
                                {/* <Link
                                    href={route('awards.destroy', award.id)}
                                    method="delete"
                                    as="button"
                                    className="text-red-500"
                                    onClick={(e) => {
                                        if (!confirm('Are you sure?')) e.preventDefault();
                                    }}
                                >
                                    Delete
                                </Link> */}
                                {/* Option 2: Manual delete handler */}
                                <button onClick={() => deleteAward(award.id)} className="text-red-500">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            {/* Pagination */}
            <div className="mt-4 flex space-x-2">
                {awards.links.map((link, i) => (
                    <Link
                        key={i}
                        href={link.url || '#'}
                        className={`rounded border px-3 py-1 ${link.active ? 'bg-blue-500 text-white' : ''}`}
                        dangerouslySetInnerHTML={{ __html: link.label }}
                    />
                ))}
            </div>
        </div>
    );
};

export default Index;
