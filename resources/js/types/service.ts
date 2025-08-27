import { Media } from './media';

export interface Service {
    id: number;
    title: string;
    slug: string;
    description?: string | null;
    gallery?: string[] | null; // since it's a JSON array
    icon_media_id?: number | null;
    media_id?: number | null;
    icon_media?: Media | null; // relation
    media?: Media | null; // relation
    status: 'Active' | 'Inactive';
    created_at: string;
    updated_at: string;
}
