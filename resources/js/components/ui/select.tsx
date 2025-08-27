import * as React from "react"
import { cn } from "@/lib/utils"

interface SelectProps extends React.ComponentProps<"select"> {
  options: { value: string; label: string }[]
}

const Select: React.FC<SelectProps> = ({ className, options, ...props }) => {
  return (
    <select
      data-slot="select"
      className={cn(
        "border-input bg-background text-base shadow-xs transition-[color,box-shadow] outline-none",
        "flex h-9 w-full min-w-0 rounded-md border px-3 py-1 md:text-sm",
        "focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50",
        "aria-invalid:border-destructive aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40",
        "disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50",
        className
      )}
      {...props}
    >
      {options.map((opt) => (
        <option key={opt.value} value={opt.value}>
          {opt.label}
        </option>
      ))}
    </select>
  )
}

export { Select }
