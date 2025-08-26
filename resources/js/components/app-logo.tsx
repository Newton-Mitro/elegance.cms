import AppLogoIcon from './app-logo-icon';

export default function AppLogo() {
    const appName = import.meta.env.VITE_APP_NAME || 'PandaCMS';
    return (
        <>
            <div className="flex aspect-square size-10 items-center justify-center rounded-md text-sidebar-primary-foreground">
                <AppLogoIcon className="h-10 w-10" />
            </div>
            <div className="ml-1 grid flex-1 text-left text-sm">
                <span className="mb-0.5 truncate leading-tight font-semibold">{appName}</span>
            </div>
        </>
    );
}
