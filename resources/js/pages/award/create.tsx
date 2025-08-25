import { Inertia } from '@inertiajs/inertia';
import React, { useState } from 'react';
import { Media } from '../../types/media';
import MediaBrowserModal from '../media/media_browser_modal';

interface CreateProps {
    media: Media[];
}

const Create: React.FC<CreateProps> = ({ media }) => {
    const [form, setForm] = useState({
        year: '',
        title: '',
        image_id: null as number | null,
    });

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [selectedMedia, setSelectedMedia] = useState<Media | null>(null);

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        Inertia.post('/awards', form);
    };

    return (
        <div>
            <h1 className="mb-4 text-2xl font-bold">Create Award</h1>

            <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                    <label className="block font-medium">Year</label>
                    <input
                        type="text"
                        value={form.year}
                        onChange={(e) => setForm({ ...form, year: e.target.value })}
                        className="w-full rounded border px-3 py-2"
                        required
                    />
                </div>

                <div>
                    <label className="block font-medium">Title</label>
                    <input
                        type="text"
                        value={form.title}
                        onChange={(e) => setForm({ ...form, title: e.target.value })}
                        className="w-full rounded border px-3 py-2"
                        required
                    />
                </div>

                <div>
                    <label className="block font-medium">Image</label>
                    {selectedMedia ? (
                        <div className="mb-2">
                            <img src={selectedMedia.url} alt={selectedMedia.file_name || 'selected'} className="h-24 rounded" />
                        </div>
                    ) : (
                        <p className="text-sm text-gray-500">No image selected</p>
                    )}
                    <button type="button" onClick={() => setIsModalOpen(true)} className="rounded bg-blue-500 px-3 py-2 text-white">
                        Browse Media
                    </button>
                </div>

                <button type="submit" className="rounded bg-green-600 px-4 py-2 text-white">
                    Save
                </button>
            </form>

            {/* Media Modal */}
            <MediaBrowserModal
                isOpen={isModalOpen}
                onClose={() => setIsModalOpen(false)}
                media={media}
                onSelect={(m) => {
                    setSelectedMedia(m);
                    setForm({ ...form, image_id: m.id });
                }}
            />
        </div>
    );
};

export default Create;
