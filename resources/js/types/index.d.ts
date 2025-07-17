import { Config } from 'ziggy-js';
import {Role} from "@/types/role";

export interface User {
    id: number;
    first_name: string;
    last_name: string;
    full_name: string;
    email: string;
    password: string;
    email_verified_at?: string;
    address: string;
    phone_number: string;
    roles: Role[];
    terms_accepted_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
