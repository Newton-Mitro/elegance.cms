import { X } from 'lucide-react';
import React, { useState } from 'react';

interface GalleryProps {
    gallery: string[];
}

const Gallery: React.FC<GalleryProps> = ({ gallery }) => {
    const [currentIndex, setCurrentIndex] = useState<number | null>(null);

    const isImage = (url: string) => /\.(jpg|jpeg|png|gif|webp|svg)$/i.test(url);
    const isVideo = (url: string) => /\.(mp4|webm|ogg)$/i.test(url);

    const prev = () => {
        if (currentIndex !== null) {
            setCurrentIndex((currentIndex - 1 + gallery.length) % gallery.length);
        }
    };

    const next = () => {
        if (currentIndex !== null) {
            setCurrentIndex((currentIndex + 1) % gallery.length);
        }
    };

    return (
        <>
            <div className="mt-2">
                <div className="grid grid-cols-1 gap-2 md:grid-cols-3">
                    {gallery.map((url, idx) => (
                        <div
                            key={idx}
                            className="cursor-pointer overflow-hidden rounded border dark:border-gray-700"
                            onClick={() => setCurrentIndex(idx)}
                        >
                            {isImage(url) ? (
                                <img src={url} alt={`gallery-${idx}`} className="h-72 w-full object-cover" />
                            ) : isVideo(url) ? (
                                <video src={url} className="h-72 w-full object-cover" muted playsInline />
                            ) : (
                                <div className="flex h-72 w-full items-center justify-center bg-gray-100 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                    File
                                </div>
                            )}
                        </div>
                    ))}
                </div>
            </div>

            {/* Modal */}
            {currentIndex !== null && (
                <div
                    className="fixed inset-0 z-50 flex items-center justify-center bg-black/95 p-4"
                    onClick={() => setCurrentIndex(null)} // Close on outside click
                >
                    <div
                        className="relative max-h-full w-full max-w-3xl overflow-auto rounded bg-white p-4 dark:bg-gray-800"
                        onClick={(e) => e.stopPropagation()} // Prevent closing when clicking inside
                    >
                        {/* Close button */}
                        <button
                            className="absolute top-2 right-2 text-lg font-bold text-gray-700 hover:text-gray-500 dark:text-gray-300 dark:hover:text-gray-400"
                            onClick={() => setCurrentIndex(null)}
                        >
                            <X />
                        </button>

                        {/* Prev/Next buttons */}
                        <button
                            className="absolute top-1/2 left-2 -translate-y-1/2 rounded-full bg-gray-200 p-2 text-lg font-bold dark:bg-gray-700"
                            onClick={prev}
                        >
                            ‹
                        </button>
                        <button
                            className="absolute top-1/2 right-2 -translate-y-1/2 rounded-full bg-gray-200 p-2 text-lg font-bold dark:bg-gray-700"
                            onClick={next}
                        >
                            ›
                        </button>

                        {/* Media Preview */}
                        {isImage(gallery[currentIndex]) ? (
                            <img src={gallery[currentIndex]} alt={`preview-${currentIndex}`} className="max-h-[80vh] w-full object-contain" />
                        ) : isVideo(gallery[currentIndex]) ? (
                            <video controls className="max-h-[80vh] w-full">
                                <source src={gallery[currentIndex]} />
                                Your browser does not support the video tag.
                            </video>
                        ) : (
                            <p className="text-center text-gray-700 dark:text-gray-300">Cannot preview this file.</p>
                        )}
                    </div>
                </div>
            )}
        </>
    );
};

export default Gallery;
