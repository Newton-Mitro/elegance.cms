import React from 'react';
import { Media } from '../types/media';

interface MediaPreviewProps {
    media: Media;
}

const MediaPreview: React.FC<MediaPreviewProps> = ({ media }) => {
    const type = media.file_type.toLowerCase();

    if (type.startsWith('image/')) {
        return (
            <div className="mt-4">
                <img src={media.url} alt={media.alt_text || media.file_name} className="max-h-64 w-full rounded-lg object-cover shadow" />
            </div>
        );
    }

    if (type.startsWith('video/')) {
        return (
            <div className="mt-4">
                <video controls className="max-h-80 w-full rounded-lg shadow">
                    <source src={media.url} type={media.file_type} />
                    Your browser does not support the video tag.
                </video>
                <p className="mt-2 text-sm text-gray-500">{media.file_name}</p>
            </div>
        );
    }

    if (type.startsWith('audio/')) {
        return (
            <div className="mt-4">
                <audio controls className="w-full">
                    <source src={media.url} type={media.file_type} />
                    Your browser does not support the audio element.
                </audio>
                <p className="mt-2 text-sm text-gray-500">{media.file_name}</p>
            </div>
        );
    }

    if (type === 'application/pdf') {
        return (
            <div className="mt-4">
                <embed src={media.url} type="application/pdf" className="h-96 w-full rounded-lg border" />
                <p className="mt-2 text-sm text-gray-500">{media.file_name}</p>
            </div>
        );
    }

    // fallback for other file types (docs, zips, etc.)
    return (
        <div className="mt-4 rounded border bg-gray-50 p-3">
            <a href={media.url} target="_blank" rel="noopener noreferrer" className="text-blue-600 hover:underline">
                {media.file_name}
            </a>
        </div>
    );
};

export default MediaPreview;
