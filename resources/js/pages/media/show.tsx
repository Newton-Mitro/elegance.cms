import { Head } from '@inertiajs/react';
import React from 'react';
import HeadingSmall from '../../components/heading-small';
import AppLayout from '../../layouts/app-layout';
import { BreadcrumbItem } from '../../types';
import { Media } from '../../types/media';

interface PageProps {
    media: Media;
}

const Show: React.FC<PageProps> = ({ media }) => {
    const renderMediaPreview = () => {
        const [mainType, subType] = media.file_type.split('/');

        if (mainType === 'image') {
            return <img src={media.url} className="w-full rounded object-cover" alt={media.alt_text || 'Image preview'} />;
        } else if (mainType === 'video') {
            return (
                <video controls className="w-full rounded">
                    <source src={media.url} type={media.file_type} />
                    Your browser does not support the video tag.
                </video>
            );
        } else if (mainType === 'audio') {
            return (
                <audio controls className="w-full">
                    <source src={media.url} type={media.file_type} />
                    Your browser does not support the audio element.
                </audio>
            );
        } else if (mainType === 'application' && subType === 'pdf') {
            // PDF preview embedded
            return <iframe src={media.url} className="h-[600px] w-full rounded border" title={media.alt_text || 'PDF Preview'} />;
        } else {
            // Other documents
            return (
                <div className="flex flex-col items-start gap-2">
                    <a href={media.url} target="_blank" rel="noopener noreferrer" className="text-blue-600 underline">
                        Open document
                    </a>
                    <a href={media.url} download className="inline-block rounded bg-green-600 px-4 py-2 text-white transition hover:bg-green-700">
                        Download
                    </a>
                </div>
            );
        }
    };

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Medias', href: '/admin/media-files' },
        { title: 'View Media', href: '' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Show Media" />
            <div className="h-[calc(100vh-100px)] space-y-8 overflow-auto p-6">
                {/* Page Header */}
                <div className="space-y-4 rounded-lg border p-4 md:w-4xl">
                    <HeadingSmall title="Show Media" description="Show media file details" />
                </div>

                {/* Media Details */}
                <div className="space-y-4 md:w-4xl">
                    {/* Media Preview */}
                    <div className="rounded border p-2">{renderMediaPreview()}</div>

                    {/* Media Info */}
                    <div className="space-y-2 p-4 text-gray-500">
                        <div>
                            <span className="font-semibold">ID: </span>
                            <span>{media.id || '-'}</span>
                        </div>
                        <div>
                            <span className="font-semibold">URL: </span>
                            <span className="break-all">{media.url}</span>
                        </div>
                        <div>
                            <span className="font-semibold">File Type: </span>
                            <span>{media.file_type}</span>
                        </div>
                        <div>
                            <span className="font-semibold">Alt Text: </span>
                            <span>{media.alt_text || '-'}</span>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
};

export default Show;
