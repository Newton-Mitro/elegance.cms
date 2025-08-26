import { Link } from '@inertiajs/react';
import React from 'react';
import { Award } from '../../types/award';

interface PageProps {
    award: Award;
}

const PublicShow: React.FC<PageProps> = ({ award }) => {
    console.log(award);
    return (
        <div className="p-6">
            <h1 className="mb-2 text-xl font-bold">{award.title}</h1>
            <p className="mb-2 text-gray-600">Year: {award.year}</p>
            {award.image && <img src={award.image.url} alt={award.title} className="mb-4 h-40" />}
            <p>{award.description}</p>
            <Link href={route('awards.index')} className="btn mt-4">
                Back to list
            </Link>
        </div>
    );
};

export default PublicShow;
