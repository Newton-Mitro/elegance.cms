import { Link } from '@inertiajs/react';
import React from 'react';
import { Award } from '../../types/award';
import { PaginationLink } from '../../types/pagination_link';

interface PageProps {
    awards: {
        data: Award[];
        links: PaginationLink[];
    };
}

const PublicIndex: React.FC<PageProps> = ({ awards }) => {
    return (
        <div className="p-6">
            <div className="mb-6 flex items-center justify-between">
                <h1 className="text-2xl font-bold">Awards</h1>
            </div>

            {/* Card Grid */}
            <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                {awards.data.map((award) => (
                    <Link
                        key={award.id}
                        href={route('awards.publicShow', award.id)}
                        className="group flex flex-col rounded-lg border p-4 shadow transition hover:shadow-lg"
                    >
                        {/* Image */}
                        {award.image ? (
                            <img
                                src={award.image.url}
                                alt={award.title}
                                className="mb-3 h-40 w-full rounded object-cover transition group-hover:opacity-90"
                            />
                        ) : (
                            <div className="mb-3 flex h-40 w-full items-center justify-center rounded bg-gray-100 text-gray-500">No Image</div>
                        )}

                        {/* Content */}
                        <h2 className="text-lg font-semibold group-hover:text-blue-600">{award.title}</h2>
                        <p className="text-sm text-gray-500">Year: {award.year}</p>
                    </Link>
                ))}
            </div>

            {/* Pagination */}
            <div className="mt-6 flex flex-wrap gap-2">
                {awards.links.map((link, i) => (
                    <Link
                        key={i}
                        href={link.url || '#'}
                        className={`rounded border px-3 py-1 ${link.active ? 'bg-blue-600 text-white' : 'hover:bg-gray-100'}`}
                        dangerouslySetInnerHTML={{ __html: link.label }}
                    />
                ))}
            </div>
        </div>
    );
};

export default PublicIndex;
