export interface Task {
    id: string;
    title: string;
    description: string;
    project_id: string;
    user_id: string;
    status: string;
    deadline: string;
    deadline_formatted: string;
}
