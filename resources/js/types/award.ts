import { Media } from './media';

export interface Award {
    id: number;
    title: string;
    year: number;
    media_id?: number;
    description: string;
    image?: Media | null;
}
